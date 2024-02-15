
import { ActionTypes } from '../constants/action-types';

export const setRegulations = (regulations) => ({
  type: ActionTypes.SET_REGULATIONS,
  payload: regulations,
});

export const addRegulation = (regulation) => ({
  type: ActionTypes.ADD_REGULATION,
  payload: regulation,
});

export const deleteRegulation = (id) => ({
  type: ActionTypes.DELETE_REGULATION,
  payload: id,
});
