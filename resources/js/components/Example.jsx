import React from 'react';
import ReactDOM from 'react-dom/client';
import Header from './Header';
import axios from "axios";
function Example() {
    // axios.post('route url', {data});
    return (
            <>
                        <Header />

            </>

    );
}

export default Example;

if (document.getElementById('example')) {
    const Index = ReactDOM.createRoot(document.getElementById("example"));

    Index.render(
        <React.StrictMode>
            <Example/>
        </React.StrictMode>
    )
}
