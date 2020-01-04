export const isArray = value => {
  if (value === undefined) {
    return false;
  }
  return value.constructor === Array;
};
export const isString = value => typeof value === "string";
export const isBoolean = value => typeof value === "boolean";
export const isNull = value => value === null;
