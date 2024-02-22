import React, { useState } from 'react';
import axios from 'axios';
import { useDispatch } from 'react-redux';
import { addSportsman } from '../../redux/actions/sportsmanActions';

const AddSportsmanForm = () => {
  const [newSportsman, setNewSportsman] = useState({
    name: '',
    email: '',
    gender: 'male',
    category: 'tennis',
    sponsor: ''
  });
  const dispatch = useDispatch();

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setNewSportsman({
      ...newSportsman,
      [name]: value
    });
  };

  const handleAddSportsman = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/sportsmans/', newSportsman);
      dispatch(addSportsman(response.data));
      setNewSportsman({
        name: '',
        email: '',
        gender: 'male',
        category: 'tennis',
        sponsor: ''
      });
    } catch (error) {
      console.error('Error adding sportsman:', error);
    }
  };

  return (
    <div>
      <h3>Add Sportsman</h3>
      <div className="input-group mb-3">
        <input
          type="text"
          name="name"
          className="form-control"
          placeholder="Name"
          value={newSportsman.name}
          onChange={handleInputChange}
          required
        />
        <input
          type="email"
          name="email"
          className="form-control"
          placeholder="Email"
          value={newSportsman.email}
          onChange={handleInputChange}
        />
        <select
          className="form-select"
          name="gender"
          value={newSportsman.gender}
          onChange={handleInputChange}
          required
        >
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
        <select
          className="form-select"
          name="category"
          value={newSportsman.category}
          onChange={handleInputChange}
          required
        >
          <option value="tennis">Tennis</option>
          <option value="marathon">Marathon</option>
          <option value="spear throwing">Spear Throwing</option>
          <option value="athletics">Athletics</option>
        </select>
        <input
          type="text"
          name="sponsor"
          className="form-control"
          placeholder="Sponsor (optional)"
          value={newSportsman.sponsor}
          onChange={handleInputChange}
        />
        <button className="btn btn-primary" onClick={handleAddSportsman}>
          Add Sportsman
        </button>
      </div>
    </div>
  );
};

export default AddSportsmanForm;
