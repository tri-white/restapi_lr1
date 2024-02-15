import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { setRegulations, addRegulation, deleteRegulation } from '../redux/actions/regulationActions';

const RegulationsList = () => {
  const navigate = useNavigate();
  const regulations = useSelector((state) => state.allRegulations.REGULATIONS);
  const [newRegulationName, setNewRegulationName] = useState('');
  const dispatch = useDispatch();
  const [pagination, setPagination] = useState([]);

  useEffect(() => {

    const fetchEmployees = async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/regulations/');
        dispatch(setRegulations(response.data.data));
        setPagination(response.data.links);
        console.log('pages');
        console.log(pagination);
      } catch (error) {
        console.error('Error fetching employees:', error);
      }
    };


    fetchEmployees();
  }, [dispatch]);

  const handleAddRegulation = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/regulations/', {
        regulation: selectedDepartment,
        employee: selectedEmployee,
        expenseType: selectedExpenseType,
        date,
        amount,
      });

      // Add the newly created competition to the competitions array
      dispatch(addRegulation(response.data));
      setNewRegulationName('');
    } catch (error) {
      console.error('Error adding expense document:', error);
    }
  };

  const handleDeleteRegulation = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/api/regulations/${id}`);
      dispatch(deleteRegulation(id));

    } catch (error) {
      console.error('Помилка при видаленні документа витрат:', error);
    }
  };

  const handleUpdateClick = (id) => {
    navigate(`/regulations/${id}/update`);
  };

  const renderList = regulations.map((regulation) => {
    const { id, name, gender, description,minimalRequirements} = regulation;

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
      </div>
    </div>
  );
};

export default RegulationsList;
