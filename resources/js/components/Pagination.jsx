import React from 'react';

const Pagination = ({ links, fetchNextPrevTasks }) => {
  return (
    <ul className="pagination">
      {Object.keys(links).map((linkKey, index) => (
        <li key={index} className="page-item">
          <a
            style={{ cursor: 'pointer' }}
            className="page-link"
            onClick={() => fetchNextPrevTasks(links[linkKey])}
          >
            {linkKey}
          </a>
        </li>
      ))}
    </ul>
  );
};

export default Pagination;
