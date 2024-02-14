import React from 'react';
import ReactDOM from 'react-dom/client';
import Header from './Header';
import Footer from './Footer';
import axios from "axios";
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { configureStore } from "@reduxjs/toolkit"
import 'bootstrap/dist/css/bootstrap.css';
import { Provider } from 'react-redux';
import store from "./redux/store";
import CompetitionsList from './containers/CompetitionsList';
import UpdateCompetition from './containers/UPDATE/UpdateCompetition';
import SportsmansList from './containers/SportsmansList';
import UpdateSportsman from './containers/UPDATE/UpdateSportsman';
import RegulationsList from './containers/RegulationsList';
import UpdateRegulation from './containers/UPDATE/UpdateRegulation';

const WelcomePage = () => (
    <div className="container mt-5 bg-success text-light p-3 py-5 h-100">
      <h1 className="display-4">Це CRUD з використанням Laravel/React/Axios/XAMPP/Bootstrap</h1>
      <p className="lead">Це перша сторінка, тут мала б бути цікава інформація в гарній обгортці</p>
    </div>
  );

function App() {
    return (
        <div className="App">
        <BrowserRouter>
            <Header />
            <Routes>
                <Route path="/" element={<WelcomePage />} />
                <Route path="/competitions" element={<CompetitionsList />} />
                <Route path="/competitions/:id/update" element={"hi"} />
                <Route path="/regulations" element={<SportsmansList />} />
                <Route path="/regulations/:id/update" element={"hi"} />
                <Route path="/sportsmans" element={<RegulationsList />} />
                <Route path="/sportsmans/:id/update" element={"hi"} />
            </Routes>
            <Footer />
        </BrowserRouter>
        </div>

    );
}

export default App;



if (document.getElementById('example')) {
    const Index = ReactDOM.createRoot(document.getElementById("example"));

    Index.render(
        <React.StrictMode>
            <Provider store={store}>
               <App />
            </Provider>
        </React.StrictMode>
    )
}
