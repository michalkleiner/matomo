<!--
  Matomo - free/libre analytics platform
  @link https://matomo.org
  @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
-->

<template>
  <div v-if="sameTimeZone">
      {{ localDate }} {{ localTime }}
  </div>
  <div v-else>
    <table>
      <thead>
        <tr>
          <th>{{ translate('CurrentLocalTimeInTZ_CurrentLocalTime') }}</th>
          <th>{{ translate('CurrentLocalTimeInTZ_CurrentLocalTimeInWebsiteTZ') }}</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td>{{ localDate }} {{ localTime }}</td>
        <td>{{ websiteDate }} {{ websiteTime }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';

interface DateTimeInTZState {
  interval?: number;
  localDate: string;
  localTime: string;
  websiteDate: string;
  websiteTime: string;
}

export default defineComponent({
  props: {
    locale: {
      type: String,
      required: true,
    },
    timezone: {
      type: String,
      required: true,
    },
  },
  data(): DateTimeInTZState {
    return {
      interval: undefined,
      localDate: '',
      localTime: '',
      websiteDate: '',
      websiteTime: '',
    };
  },
  mounted() {
    this.updateDateTime();

    this.interval = setInterval(() => {
      this.minuteTick();
    }, 60 * 1000);
  },
  unmounted() {
    clearInterval(this.interval);
  },
  methods: {
    updateDateTime() {
      const d = new Date();
      this.localDate = d.toLocaleDateString(this.locale);
      this.localTime = d.toLocaleTimeString(this.locale).replace(/:\d\d /, ' '); // replace to strip seconds

      this.websiteDate = `${d.toLocaleDateString(this.locale, { timeZone: this.timezone })}`;
      this.websiteTime = `${d.toLocaleTimeString(this.locale, { timeZone: this.timezone })}`.replace(/:\d\d /, ' ');
    },
    minuteTick() {
      this.updateDateTime();
    },
  },
  computed: {
    sameTimeZone() {
      return this.localDate === this.websiteDate && this.localTime === this.websiteTime;
    },
  },
});
</script>
