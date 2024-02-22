import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link, useNavigate } from 'react-router-dom'; // Import Link

import { useDispatch, useSelector } from 'react-redux';
import { setRegulations, addRegulation, deleteRegulation } from '../redux/actions/regulationActions';
import Pagination from '../Pagination'; 
import AddRegulationForm from './CREATE/AddRegulationForm';
import SearchInput from '../SearchInput';


const RegulationsList = () => {
  const navigate = useNavigate();
  const regulations = useSelector((state) => state.allRegulations.REGULATIONS);
  const dispatch = useDispatch();
  const [searchName, setSearchName] = useState('');
  const [page, setPage] = useState(1);
  const [links, setLinks] = useState([]);

  useEffect(() => {
    const fetchRegulations = async () => {
      try {
        const response = await axios.get(`/api/regulations?name[contains]=${searchName}&page=${page}`);
        dispatch(setRegulations(response.data.data));
        setLinks(response.data.links);
      } catch (error) {
        console.error('Error fetching regulations:', error);
      }
    };

    fetchRegulations();
  }, [dispatch, searchName, page]);


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
        <Link to="/regulations/create" className="btn btn-success mb-2">Додати норматив</Link> 

        </div>
        <h3>Список нормативів</h3>

        <div className="input-group mb-3">
        <SearchInput searchName={searchName} setSearchName={setSearchName} setPage={setPage} />
        </div>
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
