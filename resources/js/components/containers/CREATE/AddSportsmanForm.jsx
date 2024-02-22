import React, { useState } from 'react';
import axios from 'axios';
import { useDispatch } from 'react-redux';
import { addSportsman } from '../../redux/actions/sportsmanActions';
import { useNavigate, useParams } from 'react-router-dom';

const AddSportsmanForm = () => {
  const [newSportsman, setNewSportsman] = useState({
    name: '',
    email: '',
    gender: 'male',
    category: 'tennis',
    sponsor: ''
  });
  const dispatch = useDispatch();
  const navigate = useNavigate();

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
      navigate('/sportsmans');

    } catch (error) {
      console.error('Error adding sportsman:', error);
    }
  };

  return (
    <div>
  <h3>Додати спортсмена</h3>
  <div className="mb-3">
    <div>
      <label htmlFor="name" className="form-label">Ім'я</label>
      <input
        type="text"
        id="name"
        name="name"
        className="form-control"
        placeholder="Ім'я"
        value={newSportsman.name}
        onChange={handleInputChange}
        required
      />
    </div>
    <div>
      <label htmlFor="email" className="form-label">Пошта</label>
      <input
        type="email"
        id="email"
        name="email"
        className="form-control"
        placeholder="Пошта"
        value={newSportsman.email}
        onChange={handleInputChange}
      />
    </div>
    <div>
      <label htmlFor="gender" className="form-label">Стать</label>
      <select
        id="gender"
        className="form-select"
        name="gender"
        value={newSportsman.gender}
        onChange={handleInputChange}
        required
      >
        <option value="male">Чоловік</option>
        <option value="female">Жінка</option>
      </select>
    </div>
    <div>
      <label htmlFor="category" className="form-label">Категорія</label>
      <select
        id="category"
        className="form-select"
        name="category"
        value={newSportsman.category}
        onChange={handleInputChange}
        required
      >
        <option value="tennis">Теніс</option>
        <option value="marathon">Марафон</option>
        <option value="spear throwing">Метання списів</option>
        <option value="athletics">Атлетика</option>
      </select>
    </div>
    <div>
      <label htmlFor="sponsor" className="form-label">Спонсор</label>
      <input
        type="text"
        id="sponsor"
        name="sponsor"
        className="form-control"
        placeholder="Спонсор"
        value={newSportsman.sponsor}
        onChange={handleInputChange}
      />
    </div>
    <button className="btn btn-primary mt-3" onClick={handleAddSportsman}>
      Додати
    </button>
  </div>
</div>

  );
};

export default AddSportsmanForm;
