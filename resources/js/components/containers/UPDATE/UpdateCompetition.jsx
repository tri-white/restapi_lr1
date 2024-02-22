// UpdateDepartmentForm.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate, useParams } from 'react-router-dom';

const UpdateCompetitions = ({ onClose }) => {
  const { id } = useParams();
  const [competition, setCompetition] = useState({
    name: '',
    eventDate: '',
    eventLocation: '',
    prizePool: '',
    sportsType: '100m sprint'
  });
  const navigate = useNavigate();

  useEffect(() => {
    const fetchCompetitionDetails = async () => {
      try {
        const response = await axios.get(`http://localhost:8000/api/competitions/${id}`);
        setCompetition({
          ...response.data.data,
          eventDate: response.data.data.eventDate.replace('.000000Z', '')
      });
        console.log(competition);
      } catch (error) {
        console.error('Помилка при отриманні деталей змагання:', error);
      }
    };

    fetchCompetitionDetails();
  }, [id]);

  const handleUpdateCompetition = async () => {
    try {
      await axios.put(`http://localhost:8000/api/competitions/${id}`, {
        name: competition.name,
        event_date: competition.eventDate,
        event_location: competition.eventLocation,
        prize_pool: competition.prizePool,
        sports_type: competition.sportsType
      });
      navigate('/competitions');
    } catch (error) {
      console.error('Помилка при оновленні змагання:', error);
    }
  };

  const handleFormClose = () => {
    navigate('/competitions');
  };
  
  return (
    <div className="update-department-form container mt-4">
      <h2>Оновити інформацію про змагання</h2>
      <form>
        <div className="mb-3">
          <label htmlFor="name" className="form-label">Назва:</label>
          <input
            type="text"
            id="name"
            className="form-control"
            value={competition.name}
            onChange={(e) => setCompetition({ ...competition, name: e.target.value })}
          />
        </div>
        <div className="mb-3">
          <label htmlFor="eventDate" className="form-label">Дата проведення:</label>
          <input
            type="datetime-local"
            id="eventDate"
            className="form-control"
            value={competition.eventDate}
            onChange={(e) => setCompetition({ ...competition, eventDate: e.target.value })}
          />
        </div>
        <div className="mb-3">
          <label htmlFor="eventLocation" className="form-label">Місце проведення:</label>
          <input
            type="text"
            id="eventLocation"
            className="form-control"
            value={competition.eventLocation}
            onChange={(e) => setCompetition({ ...competition, eventLocation: e.target.value })}
          />
        </div>
        <div className="mb-3">
          <label htmlFor="prizePool" className="form-label">Призовий фонд ($):</label>
          <input
            type="number"
            id="prizePool"
            className="form-control"
            value={competition.prizePool}
            onChange={(e) => setCompetition({ ...competition, prizePool: e.target.value })}
          />
        </div>
        <div className="mb-3">
          <label htmlFor="sportsType" className="form-label">Вид спорту:</label>
          <select
            className="form-select"
            id="sportsType"
            value={competition.sportsType}
            onChange={(e) => setCompetition({ ...competition, sportsType: e.target.value })}
          >
            <option value="100m sprint">100m sprint</option>
            <option value="3km run">3km run</option>
            <option value="spear throwing">spear throwing</option>
            <option value="football">football</option>
            <option value="tennis">tennis</option>
          </select>
        </div>
        <button type="button" className="btn btn-primary me-2" onClick={handleUpdateCompetition}>
          Оновити
        </button>
        <button type="button" className="btn btn-secondary" onClick={handleFormClose}>
          Відміна
        </button>
      </form>
    </div>
  );
};

export default UpdateCompetitions;
