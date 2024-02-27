import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link, useNavigate } from 'react-router-dom'; // Import Link
import { useDispatch, useSelector } from 'react-redux';
import { setSportsmans, addSportsman, deleteSportsman } from '../redux/actions/sportsmanActions';
import Pagination from '../Pagination';
import AddSportsmanForm from './CREATE/AddSportsmanForm';
import SearchInput from '../SearchInput';

const SportsmanList = () => {
  const navigate = useNavigate();
  const sportsmans = useSelector((state) => state.allSportsmans.SPORTSMANS);
  const dispatch = useDispatch();
  const [searchName, setSearchName] = useState('');
  const [page, setPage] = useState(1);
  const [links, setLinks] = useState([]);

  useEffect(() => {
    const fetchSportsmans = async () => {
      try {
        const response = await axios.get(`/api/sportsmans?name[contains]=${searchName}&page=${page}`);
        dispatch(setSportsmans(response.data.data));
        setLinks(response.data.links);
      } catch (err) {
        console.log("Помилка", err);
      }
    };

    fetchSportsmans();
  }, [dispatch, searchName, page]);

  const handleDelete = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/api/sportsmans/${id}`);
      dispatch(deleteSportsman(id));

    } catch (error) {
      console.error('Помилка при видаленні спортсмена:', error);
    }
  };

  const handleUpdateClick = (id) => {
    navigate(`/sportsmans/${id}/update`);
  };

  const handleViewDetails = (id) => {
    navigate(`/sportsmans/${id}`);
  };

  const fetchNextPrevTasks = (link) => {
    const url = new URL(link);
    setPage(url.searchParams.get('page'));
  };

  const renderList = sportsmans.map((sportsman) => {
    const { id, name, email, gender, category, sponsor } = sportsman;

    return (
      <tr key={id} className="table-row">
        <td>{id}</td>
        <td>{name}</td>
        <td>{email ? email : "-"}</td>
        <td>{gender}</td>
        <td>{category}</td>
        <td>{sponsor ? sponsor : "-"}</td>

        <td>
          <button className="btn btn-primary btn-sm me-2" onClick={() => handleUpdateClick(id)}>
            Редагувати
          </button>
          <button className="btn btn-success btn-sm me-2" onClick={() => handleViewDetails(id)}>
            Деталі
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
      <h2>Спортсмени</h2>

      <Link to="/sportsmans/create" className="btn btn-success mb-2">Додати спортсмена</Link>
      <h2 className="mb-3">Список спортсменів</h2>

      <div className="input-group mb-3">
        <SearchInput searchName={searchName} setSearchName={setSearchName} setPage={setPage} />
      </div>

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
      <div>Поточна сторінка: {page}</div>
    </div>
  );
};

export default SportsmanList;
