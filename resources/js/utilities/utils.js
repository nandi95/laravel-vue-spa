// assertions
export const isArray = value => {
  if (value === undefined) {
    return false;
  }
  return value.constructor === Array;
};
export const isString = value => typeof value === "string";
export const isBoolean = value => typeof value === "boolean";
export const isNull = value => value === null;

export const setDarkTheme = bool => {
  const html = document.getElementsByTagName("html")[0];
  if (bool === "true" || bool === true) {
    html.classList.add("mode-dark");
  } else {
    html.classList.remove("mode-dark");
  }
};
