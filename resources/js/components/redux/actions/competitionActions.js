import { ActionTypes } from '../constants/action-types';

export const setCompetitions = (competitions) => ({
  type: ActionTypes.SET_COMPETITIONS,
  payload: competitions,
});

export const addCompetition = (competition) => ({
  type: ActionTypes.ADD_COMPETITION,
  payload: competition,
});

export const deleteCompetition = (competitionId) => ({
  type: ActionTypes.DELETE_COMPETITION,
  payload: competitionId,
});
