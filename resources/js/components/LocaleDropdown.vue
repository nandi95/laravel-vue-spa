<template>
  <v-select
    :options="availableLocales"
    @input="setLocale"
    v-model="lang"
    :clearable="false"
    class="bg-white dark:bg-gray-400 rounded"
  />
</template>

<script>
import { mapGetters } from "vuex";
import { loadMessages } from "~/plugins/i18n";

export default {
  computed: {
    availableLocales: function() {
      return Object.keys(this.locales).map(key => {
        return {
          label: this.locales[key],
          code: key
        };
      });
    },
    currentLocale: function() {
      return this.availableLocales.find(locale => locale.code === this.locale);
    },
    ...mapGetters({
      locale: "lang/locale",
      locales: "lang/locales"
    })
  },
  data() {
    return {
      lang: null
    };
  },
  mounted() {
    this.lang = this.currentLocale;
  },
  methods: {
    setLocale(locale) {
      if (this.$i18n.locale !== locale.code) {
        loadMessages(locale.code);
        this.$store.dispatch("lang/setLocale", locale.code);
      }
    }
  }
};
</script>
