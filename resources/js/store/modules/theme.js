import * as types from "../mutation-types";
import {isBoolean, isNull} from "../../utilities/utils";

// state
export const state = {
  themeColor: localStorage.getItem("themeColor"),
  darkMode: localStorage.getItem("darkMode")
};

// mutations
export const mutations = {
  [types.SET_THEME](state, color) {
    state.themeColor = color;
    localStorage.setItem("themeColor", color);
  },
  [types.SET_DARK_MODE](state, boolean) {
    state.darkMode = boolean;
    localStorage.setItem("darkMode", boolean);
  }
};

// getters
export const getters = {
  themeColor: state => (state.themeColor ? state.themeColor : "#5d5d5d"),
  darkMode: state => {
    if (isNull(state.darkMode)) {
      return (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
      );
    }
    return state.darkMode === "true";
  }
};

// actions
export const actions = {
  updateTheme({ commit, dispatch }, payload) {
    commit(types.SET_THEME, payload);
  },
  updateDarkMode({ commit, dispatch }, payload) {
    commit(types.SET_DARK_MODE, payload);
  }
};
