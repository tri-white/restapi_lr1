// reducers/expenseDocumentReducer.js
import { ActionTypes } from '../constants/action-types';

const initialState = {
  REGULATIONS: [],
};

export const regulationReducer = (state = initialState, action) => {
  switch (action.type) {
    case ActionTypes.SET_REGULATIONS:
      return { ...state, REGULATIONS: action.payload };
    case ActionTypes.ADD_REGULATION:
      return { ...state, REGULATIONS: [...state.REGULATIONS, action.payload] };
    case ActionTypes.DELETE_REGULATION:
      return {
        ...state,
        REGULATIONS: state.REGULATIONS.filter((regulation) => regulation.id !== action.payload),
      };
    default:
      return state;
  }
};
