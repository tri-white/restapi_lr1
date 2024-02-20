import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { setCompetitions, addCompetition, deleteCompetition } from '../redux/actions/competitionActions';
import Pagination from '../Pagination'; 

const CompetitionList = () => {
  const navigate = useNavigate();
  const competitions = useSelector((state) => state.allCompetitions.COMPETITIONS);
  const dispatch = useDispatch();
  const [searchName, setSearchName] = useState('');
  const [page, setPage] = useState(1);
  const [links, setLinks] = useState([]);
  const [newCompetition, setNewCompetition] = useState({
    name: '',
    event_date: '',
    event_location: '',
    prize_pool: '',
    sports_type: '100m sprint'
  });
  useEffect(() => {
    fetchCompetitions();
  }, [dispatch, searchName, page]);

  const fetchCompetitions = async () => {
    try {
      const response = await axios.get(`/api/competitions?name[eq]=${searchName}&page=${page}`);
      dispatch(setCompetitions(response.data.data));
      setLinks(response.data.links);
    } catch (error) {
      console.error('Помилка при отриманні змагань:', error);
    }
  };

  const handleAddCompetition = async () => {
    try {
      console.log(newCompetition);
      const response = await axios.post('http://localhost:8000/api/competitions/', {
        name: newCompetition.name,
        event_date: newCompetition.event_date,
        event_location: newCompetition.event_location,
        prize_pool: newCompetition.prize_pool,
        sports_type: newCompetition.sports_type
      });
      dispatch(addCompetition(response.data));
      setNewCompetition({
        name: '',
        event_date: '',
        event_location: '',
        prize_pool: '',
        sports_type: '100m sprint'
      });
    } catch (error) {
      console.error('Помилка при додаванні змагання:', error);
    }
  };
  
  
  const handleDeleteCompetition = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/api/competitions/${id}`);
      dispatch(deleteCompetition(id));
    } catch (error) {
      console.error('Помилка при видаленні змагання:', error);
    }
  };

  const handleUpdateClick = (id) => {
    navigate(`/competitions/${id}/update`);
  };

  const fetchNextPrevTasks = (link) => {
    const url = new URL(link);
    setPage(url.searchParams.get('page'));
  };

  const renderList = competitions.map((competition) => (
    <tr key={competition.id}>
      <td>{competition.id}</td>
      <td>{competition.name}</td>
      <td>{competition.eventDate}</td>
      <td>{competition.eventLocation}</td>
      <td>{competition.sportsType}</td>
      <td>{competition.prizePool}</td>
      <td>
        <button className="btn btn-primary btn-sm me-2" onClick={() => handleUpdateClick(competition.id)}>
          Редагувати
        </button>
        <button className="btn btn-danger btn-sm" onClick={() => handleDeleteCompetition(competition.id)}>
          Видалити
        </button>
      </td>
    </tr>
  ));

  return (
    <div className="container mt-4">
      <h2>Змагання</h2>

      <div className="mb-3">
  <h3>Додати змагання</h3>
  <div className="input-group mb-3">
    <input
      type="text"
      id="competitionName"
      className="form-control"
      placeholder="Назва змагання"
      value={newCompetition.name}
      onChange={(e) => setNewCompetition({...newCompetition, name: e.target.value })}
    />
    <input
      type="datetime-local"
      id="eventDate"
      className="form-control"
      placeholder="Дата проведення"
      value={newCompetition.event_date}
      onChange={(e) => {

        setNewCompetition({ ...newCompetition, event_date: e.target.value });
      }}
      required
    />

    <input
      type="text"
      id="eventLocation"
      className="form-control"
      placeholder="Місце проведення"
      value={newCompetition.event_location}
      onChange={(e) => setNewCompetition({ ...newCompetition, event_location: e.target.value })}
      required
    />
    <input
      type="number"
      id="prizePool"
      className="form-control"
      placeholder="Призовий фонд ($)"
      value={newCompetition.prize_pool}
      onChange={(e) => setNewCompetition({ ...newCompetition, prize_pool: e.target.value })}
      required
    />
    <select
      className="form-select"
      id="sportsType"
      value={newCompetition.sports_type}
      onChange={(e) => setNewCompetition({ ...newCompetition, sports_type: e.target.value })}
      required
    >
      <option value="100m sprint">100m sprint</option>
      <option value="3km run">3km run</option>
      <option value="spear throwing">spear throwing</option>
      <option value="football">football</option>
      <option value="tennis">tennis</option>
    </select>
    <button className="btn btn-primary" onClick={handleAddCompetition}>
      Додати змагання
    </button>
  </div>

        <h3>Список змагань</h3>
        <div className="input-group mb-3">
          <input
            type="text"
            className="form-control"
            placeholder="Пошук за назвою змагання"
            value={searchName}
            onChange={(e) => {
              setSearchName(e.target.value);
              setPage(1);
            }}
          />
        </div>
        <table className="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Назва змагання</th>
              <th>Дата проведення</th>
              <th>Місце проведення</th>
              <th>Вид спорту</th>
              <th>Призовий фонд ($)</th>
              <th>Дії</th>
            </tr>
          </thead>
          <tbody>{renderList}</tbody>
        </table>
        <div>
          <Pagination links={links} fetchNextPrevTasks={fetchNextPrevTasks} />
        </div>
        <div>Current Page: {page}</div>
      </div>
    </div>
  );
};

export default CompetitionList;
