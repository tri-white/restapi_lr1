import React from 'react';
import ReactDOM from 'react-dom/client';
import axios from "axios";
import { Link } from 'react-router-dom';

function Header() {
    return (
        <div className='container'>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><Link to="/competitions" class="dropdown-item" href="#">Competitions</Link></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><Link to="/sportsmans" class="dropdown-item" href="#">Sportsmans</Link></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><Link to="/regulations" class="dropdown-item" href="#">Regulations</Link></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
        </div>
    );
}

export default Header;

