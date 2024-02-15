
import { ActionTypes } from '../constants/action-types';

const initialState = {
  COMPETITIONS: [],
};

export const competitionReducer = (state = initialState, action) => {
  switch (action.type) {
    case ActionTypes.SET_COMPETITIONS:
      return { ...state, COMPETITIONS: action.payload };
    case ActionTypes.ADD_COMPETITION:
      return { ...state, COMPETITIONS: [...state.COMPETITIONS, action.payload] };
    case ActionTypes.DELETE_COMPETITION:
      return {
        ...state,
        COMPETITIONS: state.COMPETITIONS.filter((competition) => competition.id !== action.payload),
      };
    default:
      return state;
  }
};
