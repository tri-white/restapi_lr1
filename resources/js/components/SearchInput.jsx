import React from 'react';

const SearchInput = ({ searchName, setSearchName, setPage }) => {
  const handleInputChange = (e) => {
    setSearchName(e.target.value);
    setPage(1);
  };

  return (
    <div className="input-group mb-3">
      <input
        type="text"
        className="form-control"
        placeholder="Search by name"
        value={searchName}
        onChange={handleInputChange}
      />
    </div>
  );
};

export default SearchInput;
