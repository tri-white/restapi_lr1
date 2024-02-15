import { ActionTypes } from "../constants/action-types"


const initialState = {
    SPORTSMANS:[],
}

export const sportsmanReducer = (state = initialState,action)=>{

    switch(action.type){
        case ActionTypes.SET_SPORTSMANS:
            return {...state, SPORTSMANS:action.payload};
        case ActionTypes.ADD_SPORTSMAN:
                return { ...state, SPORTSMANS: [...state.SPORTSMANS, action.payload] };
        case ActionTypes.DELETE_SPORTSMAN:
                return {
                    ...state,
                    SPORTSMANS: state.SPORTSMANS.filter((sportsman) => sportsman.id !== action.payload),
                };
        default:
            return state;
    }
}