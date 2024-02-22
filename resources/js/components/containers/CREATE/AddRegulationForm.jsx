import React, { useState } from 'react';
import axios from 'axios';
import { useDispatch } from 'react-redux';
import { addRegulation } from '../../redux/actions/regulationActions';

const AddRegulationForm = () => {
  const [newRegulation, setNewRegulation] = useState({
    name: '',
    description: '',
    minimal_requirements: '',
    gender: 'male'
  });
  const dispatch = useDispatch();

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setNewRegulation({
      ...newRegulation,
      [name]: value
    });
  };

  const handleAddRegulation = async () => {
    try {
      await axios.post('http://localhost:8000/api/regulations/', newRegulation);
      dispatch(addRegulation(newRegulation));
      setNewRegulation({
        name: '',
        description: '',
        minimal_requirements: '',
        gender: 'male'
      });
    } catch (error) {
      console.error('Error adding regulation:', error);
    }
  };

  return (
    <div>
      <h2>Додати норматив</h2>
      <form>
        <div className="mb-3">
          <label htmlFor="name" className="form-label">Назва:</label>
          <input
            type="text"
            id="name"
            name="name"
            className="form-control"
            value={newRegulation.name}
            onChange={handleInputChange}
            required
          />
        </div>
        <div className="mb-3">
          <label htmlFor="description" className="form-label">Опис:</label>
          <textarea
            id="description"
            name="description"
            className="form-control"
            value={newRegulation.description}
            onChange={handleInputChange}
            required
          ></textarea>
        </div>
        <div className="mb-3">
          <label htmlFor="minimal_requirements" className="form-label">Мінімальні вимоги:</label>
          <input
            type="text"
            id="minimal_requirements"
            name="minimal_requirements"
            className="form-control"
            value={newRegulation.minimal_requirements}
            onChange={handleInputChange}
            required
          />
        </div>
        <div className="mb-3">
          <label htmlFor="gender" className="form-label">Стать:</label>
          <select
            id="gender"
            name="gender"
            className="form-select"
            value={newRegulation.gender}
            onChange={handleInputChange}
            required
          >
            <option value="male">Чоловіча</option>
            <option value="female">Жіноча</option>
            <option value="unisex">Унісекс</option>
          </select>
        </div>
        <button type="button" className="btn btn-primary" onClick={handleAddRegulation}>
          Додати норматив
        </button>
      </form>
    </div>
  );
};

export default AddRegulationForm;
