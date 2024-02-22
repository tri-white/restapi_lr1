import React from 'react';
import ReactDOM from 'react-dom/client';
import Header from './Header';
import Footer from './Footer';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.css';
import CompetitionsList from './containers/CompetitionsList';
import SportsmansList from './containers/SportsmansList';
import RegulationsList from './containers/RegulationsList';
import { Provider } from 'react-redux';
import store from "./redux/store";
import UpdateCompetitions from './containers/UPDATE/UpdateCompetition';
import UpdateRegulations from "./containers/UPDATE/UpdateRegulation";
import UpdateSportsmans from "./containers/UPDATE/UpdateSportsman";
import AddSportsmanForm from './containers/CREATE/AddSportsmanForm';
import AddRegulationForm from './containers/CREATE/AddRegulationForm';
import AddCompetitionForm from './containers/CREATE/AddCompetitionForm';
import CompetitionDetails from './containers/DETAILS/CompetitionDetails';
import SportsmanDetails from './containers/DETAILS/SportsmanDetails';
const WelcomePage = () => (
    <div className="container mt-5 bg-success text-light p-3 py-5 h-100">
      <h1 className="display-4">Це CRUD</h1>
    </div>
  );

function App() {
    return (
        <div className="App container">
        <BrowserRouter>
            <Header />
            <Routes>
                <Route path="/" element={<WelcomePage />} />
                <Route path="/competitions" element={<CompetitionsList />} />
                <Route path="/competitions/:id/update" element={<UpdateCompetitions/>} />
                <Route path="/regulations" element={<RegulationsList />} />
                <Route path="/regulations/:id/update" element={<UpdateRegulations />} />
                <Route path="/sportsmans" element={<SportsmansList />} />
                <Route path="/sportsmans/:id/update" element={<UpdateSportsmans />} />
                <Route path="/sportsmans/create" element={<AddSportsmanForm />} />
                <Route path="/regulations/create" element={<AddRegulationForm />} />
                <Route path="/competitions/create" element={<AddCompetitionForm />} />
                <Route path="/competitions/:id" element={<CompetitionDetails/>} />
                <Route path="/sportsmans/:id" element={<SportsmanDetails/>} />
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
