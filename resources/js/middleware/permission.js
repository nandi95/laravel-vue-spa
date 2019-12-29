/**
 * Middleware to check for a given role.  Not currently used anywhere in this
 * project, but here as an example of middleware functions that accept a
 * parameter.  Add this to your component with
 *
 * middleware: 'permission:edit.post|read.post|etc'
 *
 * ... to restrict a component to users who has any of these permissions.
 */
export default (to, from, next, permissions) => {
  if (permissions && Array.isArray(permissions)) {
    if (EventBus.$canAll(permissions)) {
      next("/404");
    }
  }

  next();
};
