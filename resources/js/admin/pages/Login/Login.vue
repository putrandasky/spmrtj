<template>
  <div class="auth-page">
    <b-container>
      <h5 class="auth-logo">
        <b-img src="./img/logo-mrtj-small.png"/>
        <span class="mx-5">
             Admin Panel
            </span>

        <b-img src="./img/jaklingko-icon-small.png"/>
      </h5>
      <h5  class="text-center">
          Survey Preferensi Kebijakan Pelayanan Publik
      </h5>
      <Widget class="widget-auth mx-auto" title="<h3 class='mt-0'>Login Area</h3>" customHeader>
        <!-- <p class="widget-auth-info">
            Use your email to sign in.
        </p> -->
        <form class="mt" @submit.prevent="login">
          <b-alert class="alert-sm" variant="danger" :show="!!errorMessage">
            {{errorMessage}}
          </b-alert>
          <div class="form-group">
            <input class="form-control no-border" ref="username" required type="text" name="username" placeholder="Username" />
          </div>
          <div class="form-group">
            <input class="form-control no-border" ref="password" required type="password" name="password" placeholder="Password" />
          </div>
          <b-button type="submit" size="sm" class="auth-btn mb-3" variant="inverse">Login</b-button>
          <!-- <p class="widget-auth-info">or sign in with</p>
          <div class="social-buttons">
            <b-button variant="primary" class="social-button mb-2">
              <i class="social-icon social-google"></i>
              <p class="social-text">GOOGLE</p>
            </b-button>
            <b-button variant="success" class="social-button">
              <i class="social-icon social-microsoft"></i>
              <p class="social-text">MICROSOFT</p>
            </b-button>
          </div> -->
        </form>
        <!-- <p class="widget-auth-info">
          Don't have an account? Sign up now!
        </p>
        <router-link class="d-block text-center" to="login">Create an Account</router-link> -->
      </Widget>
    </b-container>
    <footer class="auth-footer">
      Alterfingers
    </footer>
  </div>
</template>

<script>
import Widget from '@/admin/components/Widget/Widget';

export default {
  name: 'LoginPage',
  components: { Widget },
  data() {
    return {
      errorMessage: null,
    };
  },
  methods: {
    login() {
    //   const email = this.$refs.email.value;
    //   const password = this.$refs.password.value;

    //   if (email.length !== 0 && password.length !== 0) {
    //     window.localStorage.setItem('authenticated', true);
    //     this.$router.push('/app/dashboard');
    //   }
    },
  },
  created() {
    // if (window.localStorage.getItem('authenticated') === 'true') {
    //   this.$router.push('/app/main/analytics');
    // }
  },
};
</script>
