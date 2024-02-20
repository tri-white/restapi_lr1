import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { setRegulations, addRegulation, deleteRegulation } from '../redux/actions/regulationActions';
import Pagination from '../Pagination'; 

const RegulationsList = () => {
  const navigate = useNavigate();
  const regulations = useSelector((state) => state.allRegulations.REGULATIONS);
  const [newRegulationName, setNewRegulationName] = useState('');
  const dispatch = useDispatch();
  const [pagination, setPagination] = useState([]);
  const [searchName, setSearchName] = useState('');
  const [page, setPage] = useState(1);
  const [links, setLinks] = useState([]);

  useEffect(() => {
    const fetchRegulations = async () => {
      try {
        const response = await axios.get(`/api/regulations?name[eq]=${searchName}&page=${page}`);
        dispatch(setRegulations(response.data.data));
        setLinks(response.data.links);
      } catch (error) {
        console.error('Error fetching regulations:', error);
      }
    };

    fetchRegulations();
  }, [dispatch, searchName, page]);

  const handleAddRegulation = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/regulations/', {
        regulation: selectedDepartment,
        employee: selectedEmployee,
        expenseType: selectedExpenseType,
        date,
        amount,
      });

      dispatch(addRegulation(response.data));
      setNewRegulationName('');
    } catch (error) {
      console.error('Error adding regulation:', error);
    }
  };

  const fetchNextPrevTasks = (link) => {
    const url = new URL(link);
    setPage(url.searchParams.get('page'));
  }

  const handleDeleteRegulation = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/api/regulations/${id}`);
      dispatch(deleteRegulation(id));
    } catch (error) {
      console.error('Error deleting regulation:', error);
    }
  };

  const handleUpdateClick = (id) => {
    navigate(`/regulations/${id}/update`);
  };

  const renderList = regulations.map((regulation) => {
    const { id, name, gender, description, minimalRequirements } = regulation;

    return (
      <tr key={id}>
        <td>{id}</td>
        <td>{name}</td>
        <td>{description}</td>
        <td>{gender}</td>
        <td>{minimalRequirements}</td>
        <td>
          <button className="btn btn-primary me-2" onClick={() => handleUpdateClick(id)}>Редагувати</button>
          <button className="btn btn-danger" onClick={() => handleDeleteRegulation(id)}>Видалити</button>
        </td>
      </tr>
    );
  });

  return (
    <div className="container mt-4">
      <h2>Нормативи</h2>
      <div className="expense-document-list">
        <div>
          <h2>Додати норматив</h2>
          <form>
            <button type="button" className="btn btn-primary" onClick={handleAddRegulation}>
              Додати норматив
            </button>
          </form>
        </div>
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
        <h3>Список документів витрат</h3>
        <table className="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Назва</th>
              <th>Опис</th>
              <th>Стать</th>
              <th>Вимоги</th>
            </tr>
          </thead>
          <tbody>
            {renderList}
          </tbody>
        </table>
        <div>
          <Pagination links={links} fetchNextPrevTasks={fetchNextPrevTasks} />
        </div>
        <div>Current Page: {page}</div> {/* Display current page */}
      </div>
    </div>
  );
};

export default RegulationsList;
