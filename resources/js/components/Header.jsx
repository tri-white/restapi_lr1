import React from 'react';
import ReactDOM from 'react-dom/client';
import axios from "axios";
import { Link } from 'react-router-dom';

function Header() {
    return (
        <div className='container'>
        <nav className="navbar navbar-expand-lg bg-body-tertiary">
  <div className="container-fluid">
  <a className="navbar-brand" aria-current="page" href="#"><Link to="/" className="dropdown-item" href="#">Home</Link></a>

    <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span className="navbar-toggler-icon"></span>
    </button>
    <div className="collapse navbar-collapse" id="navbarNavDropdown">
      <ul className="navbar-nav">
        <li className="nav-item">
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#"><Link to="/competitions" className="dropdown-item" href="#">Змагання</Link></a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#"><Link to="/sportsmans" className="dropdown-item" href="#">Спортсмени</Link></a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#"><Link to="/regulations" className="dropdown-item" href="#">Перелік нормативів</Link></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
        </div>
    );
}

export default Header;

