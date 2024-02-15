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

const WelcomePage = () => (
    <div className="container mt-5 bg-success text-light p-3 py-5 h-100">
      <h1 className="display-4">Це CRUD</h1>
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
