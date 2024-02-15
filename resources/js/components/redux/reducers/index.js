import { combineReducers } from "redux";
import {sportsmanReducer} from "./sportsmanReducer"
import { competitionReducer } from "./competitionReducer";
import { regulationReducer } from "./regulationReducer";
const reducers = combineReducers({
    allSportsmans: sportsmanReducer,
    allCompetitions: competitionReducer,
    allRegulations: regulationReducer
})

export default reducers;