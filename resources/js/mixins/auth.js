import { isString } from "../utilities/utils";

export default {
  methods: {
    $can(permission) {
      return this.$store.getters["auth/permissions"].indexOf(permission) !== -1;
    },
    $cannot(permission) {
      return !this.$can(permission);
    },
    $canAny(permissions) {
      if (isString(permissions)) {
        permissions = permissions.split("|");
      }

      return (
        this.$store.getters["auth/permissions"].filter(permission => {
          return permissions.includes(permission);
        }).length > 0
      );
    },
    $canAll(permissions) {
      if (isString(permissions)) {
        permissions = permissions.split("|");
      }
      return permissions.every(permission => {
        return this.$store.getters["auth/permissions"].includes(permission);
      });
    },
    $role(role) {
      return this.$store.getters["auth/roles"].indexOf(role) !== -1;
    },
    $unlessRole(role) {
      return !this.$role(role);
    },
    $hasRole(role) {
      return this.$role(role);
    },
    $hasAnyRole(roles) {
      if (isString(roles)) {
        roles = roles.split("|");
      }
      return (
        this.$store.getters["auth/roles"].filter(role => {
          roles.includes(role);
        }).length > 0
      );
    },
    $hasAllRoles(roles) {
      if (isString(roles)) {
        roles = roles.split("|");
      }
      return roles.every(role => {
        return this.$store.getters["auth/roles"].includes(role);
      });
    }
  }
};
