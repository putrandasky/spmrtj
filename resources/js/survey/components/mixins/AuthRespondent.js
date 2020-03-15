export const AuthRespondent = {
    data() {
        return {
            isChecking: true,
            status: ""
        };
    },
    created() {
        this.checkExist();
    },
    methods: {
        checkExist() {
            // console.log(typeof this.$route.query.token === 'undefined');
            let self = this;
            this.isChecking = true;
            if (localStorage.token_respondent) {
                axios
                    .get(
                        `respondent/survey/auth-respondent?token=${localStorage.token_respondent}`
                    )
                    .then(response => {
                        console.log(response.data);
                        if (response.data.status == "exist") {
                            this.$store.dispatch("storeToken", response.data);
                            if (this.$route.name !== response.data.step) {
                                this.handleRoute(
                                    response.data.token,
                                    response.data.step
                                );
                            }
                        } else {
                            console.log("new1");
                            //   localStorage.token_respondent = response.data.token
                            this.handleRoute(response.data.token, "Welcome");
                            this.isChecking = false;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                let token =
                    typeof this.$route.query.token === "undefined"
                        ? false
                        : this.$route.query.token;
                if (token) {
                    axios
                        .get(`respondent/survey/auth-respondent?token=${token}`)
                        .then(response => {
                            // console.log(response.data);
                            if (response.data.status == "exist") {
                                console.log("exist");
                                this.$store.dispatch(
                                    "storeToken",
                                    response.data
                                );
                                if (this.$route.name !== response.data.step) {
                                    this.handleRoute(
                                        response.data.token,
                                        response.data.step
                                    );
                                }
                            } else {
                                // localStorage.token_respondent = response.data.token
                                if (this.$route.name !== "SocialData") {
                                    if (this.$route.name !== "Welcome") {
                                        this.handleRoute(
                                            response.data.token,
                                            "Welcome"
                                        );
                                    }
                                }
                                // if (this.$route.name == "Welcome") {
                                //     console.log("new2");
                                //     this.$router.replace({
                                //         query: Object.assign({}, this.$route.query, {
                                //             token: response.data.token
                                //         })
                                //     });
                                // }
                                this.isChecking = false;
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                } else {
                    axios
                        .get(`respondent/survey/auth-respondent`)
                        .then(response => {
                            console.log("new");
                            console.log(response.data);
                            //   localStorage.token_respondent = response.data.token
                            if (this.$route.name !== "SocialData") {
                                if (this.$route.name !== "Welcome") {
                                    this.handleRoute(
                                        response.data.token,
                                        "Welcome"
                                    );
                                }
                            }
                            if (this.$route.name == "Welcome") {
                                this.$router.replace({
                                    query: Object.assign({}, this.$route.query, {
                                        token: response.data.token
                                    })
                                });
                            }
                            this.isChecking = false;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            }
        },
        handleRoute(token, routeName) {
            this.$router.replace({
                name: routeName,
                query: Object.assign({}, this.$route.query, {
                    token: token
                })
            });
            this.isChecking = false;
        }
    }
};
