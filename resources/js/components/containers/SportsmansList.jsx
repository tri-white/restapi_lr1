import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { setSportsmans, addSportsman, deleteSportsman} from '../redux/actions/sportsmanActions';
import Pagination from '../Pagination'; 

const EmployeeList = () => {
  const navigate = useNavigate();
  const sportsmans = useSelector((state) => state.allSportsmans.SPORTSMANS);
  const [newSportsmanName, setNewSportsmanName] = useState('');
  const dispatch = useDispatch();
  const [pagination, setPagination] = useState([]);
  const [searchName, setSearchName] = useState('');
  const [page, setPage] = useState(1);
  const [links, setLinks] = useState([]);

  useEffect(() => {
    
  const fetchSportsmans = async () => {
    try {
      const response = await axios.get(`/api/sportsmans?name[eq]=${searchName}&page=${page}`);
      dispatch(setSportsmans(response.data.data));
      setLinks(response.data.links);

    } catch (err) {
      console.log("Помилка", err);
    }
  };

    fetchSportsmans();
  }, [dispatch, searchName,page]);

  const handleDelete = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/api/sportsmans/${id}`);
      dispatch(deleteSportsman(id));
  
    } catch (error) {
      console.error('Помилка при видаленні працівника:', error);
    }
  };

  const handleUpdateClick = (id) => {
    navigate(`/sportsmans/${id}/update`);
  };

  const handleAdd = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/sportsmans/', {
        name,
      });

      dispatch(addSportsman(response.data));
      setNewSportsmanName('');
      //navigate('/employees');
    } catch (error) {
      console.error('Помилка при додаванні працівника:', error);
    }
  };
  const fetchNextPrevTasks = (link) => {
    const url = new URL(link);
    setPage(url.searchParams.get('page'));
  }

  const renderList = useSelector((state) => state.allSportsmans.SPORTSMANS).map((sportsman) => {
    const { id, name, email, gender, category, sponsor } = sportsman;

    return (
      <tr key={id} className="table-row">
        <td>{id}</td>
        <td>{name}</td>
        <td>{email}</td>
        <td>{gender}</td>
        <td>{category}</td>
        <td>{sponsor ? sponsor : "-"}</td>

        <td>
          <button className="btn btn-primary btn-sm me-2" onClick={() => handleUpdateClick(id)}>
            Редагувати
          </button>
          <button className="btn btn-danger btn-sm" onClick={() => handleDelete(id)}>
            Видалити
          </button>
        </td>
      </tr>
    );
  });

  return (
    <div className="container mt-4">
      <h2 className="mb-3">Додати спортсмена</h2>
      <form className="mb-4">
        
        <button type="button" className="btn btn-primary" onClick={handleAdd}>
          Додати спортсмена
        </button>
      </form>
      <div className="input-group mb-3">
          <input
            type="text"
            className="form-control"
            placeholder="Пошук за назвою"
            value={searchName}
            onChange={(e) => {
              setSearchName(e.target.value);
              setPage(1);
            }}
          />
        </div>
      <h2 className="mb-3">Список спортсменів</h2>

      <table className="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Пошта</th>
            <th>Стать</th>
            <th>Спорт</th>
            <th>Спонсор</th>
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
  );
};

export default EmployeeList;
