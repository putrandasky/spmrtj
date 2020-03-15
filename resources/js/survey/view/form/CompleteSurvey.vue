<template>
  <div>
    <!-- <b-btn class="float-button" v-b-tooltip.hover.left="'Add New Document'">
      <i class="fa fa-plus"></i> Isi data dirimu disini ya!
    </!-->
    <div class=" text-center">
      <!-- <h3>Selesai !</h3> -->
      <h1 class="display-3 font-weight-bold">TERIMA KASIH!</h1>
      <h5
        class="text-primary mb-5"
      >Partisipasi Anda sangat membantu kami dalam mewujudkan transportasi publik yang semakin baik</h5>
      <strong
        class=""
      >Silahkan mengisi data diri Anda untuk memperoleh kesempatan mendapatkan souvenir menarik</strong>
      <br />
      <strong
        class=""
      >Responden beruntung akan kami hubungi melalui kontak yang diberikan!</strong>
    </div>

    <div class="text-center w-100">
      <small class="">
        <em>Nb: Informasi data diri yang Anda berikan akan dijaga kerahasiannya.</em>
      </small>
    </div>

  </div>
</template>
<script>
// import animationData from "@/survey/assets/checked_done_blue.js";
// import Datepicker from "vuejs-datepicker";
import { AuthRespondent } from "@/survey/components/mixins/AuthRespondent";
export default {
  name: "CompleteSurvey",
  mixins: [AuthRespondent],
  components: {
    // Datepicker
  },
  data: function() {
    return {
      configCalendar: {
        dateFormat: "d-M-y"
      },
      defaultOptions: {
        animationData: animationData,
        loop: false
      },
      animationSpeed: 1,
      modalComplete: false,
      isLoading: false,
      inputDataModal: false,
      isSubmitted: false,
      input: {
        phone: null,
        name: "",
        email: "",
        address: "",
        comment: ""
      },
      errors: {
        phone: null,
        name: "",
        email: "",
        address: "",
        comment: null
      }
    };
  },
  computed: {
    statePhone() {
      return this.errors.phone == "no-error"
        ? true
        : this.errors.phone
        ? false
        : null;
    },
    stateEmail() {
      return this.errors.email == "no-error"
        ? true
        : this.errors.email
        ? false
        : null;
    },
    stateAddress() {
      return this.errors.address == "no-error"
        ? true
        : this.errors.address
        ? false
        : null;
    },
    stateBirthDate() {
      return this.errors.birthdate == "no-error"
        ? true
        : this.errors.birthdate
        ? false
        : null;
    },
    stateName() {
      return this.errors.name == "no-error"
        ? true
        : this.errors.name
        ? false
        : null;
    },
    stateComment() {
      return this.errors.comment == "no-error"
        ? true
        : this.errors.comment
        ? false
        : null;
    }
  },
  created() {
    // this.getData();
    // fbq("track", "SubmitApplication");
  },
  methods: {
    handleAnimation: function(anim) {
      this.anim = anim;
    },
    getData() {
      let self = this;
      this.isLoading = true;
      axios
        .get(`survey/form/social-data?token=${this.$route.query.token}`)
        .then(response => {
          console.log("TCL: getData -> social-data", response.data);
          if (response.data.phone) {
            self.isSubmitted = true;
          }
          self.isLoading = false;
        })
        .catch(error => {
          console.log(error);
        });
    },
    postData(e) {
      e.preventDefault();
      let self = this;

      axios
        .post(
          `survey/form/social-data/store-personal-data?token=${this.$route.query.token}`,
          this.input
        )
        .then(response => {
          self.isSubmitted = true;
          this.inputDataModal = false;
          this.modalComplete = true;
          fbq("track", "CompleteRegistration");
        })
        .catch(error => {
          console.log(error);
          let errors = error.response.data.errors;
          this.errors.name = errors.name ? errors.name[0] : "no-error";
          this.errors.phone = errors.phone ? errors.phone[0] : "no-error";
          this.errors.address = errors.address ? errors.address[0] : "no-error";
          this.errors.email = errors.email ? errors.email[0] : "no-error";
          this.errors.comment = errors.comment ? errors.comment[0] : "no-error";
        });
    }
  }
};
</script>
<style >
</style>
