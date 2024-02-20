import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { setCompetitions, addCompetition, deleteCompetition } from '../redux/actions/competitionActions';
import Pagination from '../Pagination'; 

const CompetitionList = () => {
  const navigate = useNavigate();
  const competitions = useSelector((state) => state.allCompetitions.COMPETITIONS);
  const [newCompetitionName, setNewCompetitionName] = useState('');
  const dispatch = useDispatch();
  const [searchName, setSearchName] = useState('');
  const [page, setPage] = useState(1);
  const [links, setLinks] = useState([]);

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
      const response = await axios.post('http://localhost:8000/api/competitions/', 
        { 
          name: newCompetitionName,
        }
      );
      dispatch(addCompetition(response.data));
      setNewCompetitionName('');
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
            value={newCompetitionName}
            onChange={(e) => setNewCompetitionName(e.target.value)}
          />
          <button className="btn btn-primary" onClick={handleAddCompetition}>
            Додати змагання
          </button>
        </div>
      </div>

      <div>
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
