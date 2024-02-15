import { ActionTypes } from "../constants/action-types"

export const setSportsmans = (sportsmans) => {
    return {
        type: ActionTypes.SET_SPORTSMANS,
        payload: sportsmans,
    }
}

export const addSportsman = (sportsman) => ({
    type: ActionTypes.ADD_SPORTSMAN,
    payload: sportsman,
  });

export const deleteSportsman = (id) => ({
    type: ActionTypes.DELETE_SPORTSMAN,
    payload: id,
  });
