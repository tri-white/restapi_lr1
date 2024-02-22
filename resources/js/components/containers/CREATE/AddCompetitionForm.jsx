import React, { useState } from 'react';
import axios from 'axios';
import { useDispatch } from 'react-redux';
import { addCompetition } from '../../redux/actions/competitionActions';
const AddCompetitionForm = () => {
  const [newCompetition, setNewCompetition] = useState({
    name: '',
    event_date: '',
    event_location: '',
    prize_pool: '',
    sports_type: '100m sprint'
  });
  const dispatch = useDispatch();

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setNewCompetition({
      ...newCompetition,
      [name]: value
    });
  };

  const handleAddCompetition = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/competitions/', newCompetition);
      setNewCompetition({
        name: '',
        event_date: '',
        event_location: '',
        prize_pool: '',
        sports_type: '100m sprint'
      });
      dispatch(addCompetition(response.data));
   
    } catch (error) {
      console.error('Error adding competition:', error);
    }
  };

  return (
    <div>
      <h3>Додати змагання</h3>
      <div className="input-group mb-3">
        <input
          type="text"
          id="competitionName"
          name="name"
          className="form-control"
          placeholder="Назва змагання"
          value={newCompetition.name}
          onChange={handleInputChange}
          required
        />
        <input
          type="datetime-local"
          id="eventDate"
          name="event_date"
          className="form-control"
          placeholder="Дата проведення"
          value={newCompetition.event_date}
          onChange={handleInputChange}
          required
        />
        <input
          type="text"
          id="eventLocation"
          name="event_location"
          className="form-control"
          placeholder="Місце проведення"
          value={newCompetition.event_location}
          onChange={handleInputChange}
          required
        />
        <input
          type="number"
          id="prizePool"
          name="prize_pool"
          className="form-control"
          placeholder="Призовий фонд ($)"
          value={newCompetition.prize_pool}
          onChange={handleInputChange}
          required
        />
        <select
          className="form-select"
          id="sportsType"
          name="sports_type"
          value={newCompetition.sports_type}
          onChange={handleInputChange}
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
    </div>
  );
};

export default AddCompetitionForm;
