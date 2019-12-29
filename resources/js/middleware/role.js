/**
 * Middleware to check for a given role.  Not currently used anywhere in this
 * project, but here as an example of middleware functions that accept a
 * parameter.  Add this to your component with
 *
 * middleware: 'role:admin|manager|supervisor'
 *
 * ... to restrict a component to users which one of those three roles.
 */
export default (to, from, next, roles) => {
  if (roles && Array.isArray(roles)) {
    if (EventBus.$hasAnyRole(roles)) {
      next("/404");
    }
  }

  next();
};
