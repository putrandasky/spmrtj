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
                console.log("has token in local storage");

                axios
                    .get(
                        `respondent/survey/auth-respondent?token=${localStorage.token_respondent}`
                    )
                    .then(response => {
                        if (response.data.status == "exist") {
                            console.log(
                                "token is in local storage & exist in database"
                            );
                            this.$store.dispatch("storeToken", response.data);
                            if (this.$route.name !== response.data.step) {
                                this.handleRoute(
                                    response.data.token,
                                    response.data.step
                                );
                                return;
                            }
                            if (typeof this.$route.query.token === "undefined" || this.$route.query.token !== response.data.token) {
                                this.$router.replace({
                                    query: Object.assign({}, this.$route.query, {
                                        token: response.data.token
                                    })
                                });
                                return
                            }
                            return;
                        } else {
                            console.log(
                                "token in local storage & not exist in database"
                            );
                            localStorage.token_respondent = response.data.token;
                            if (this.$route.name !== "SocialData") {
                                if (this.$route.name !== "Welcome") {
                                    this.handleRoute(
                                        response.data.token,
                                        "Welcome"
                                    );
                                    return;
                                }
                            }
                            // console.log(
                            //     "test"
                            // );
                            if (typeof this.$route.query.token === "undefined") {
                                this.$router.replace({
                                    query: Object.assign({}, this.$route.query, {
                                        token: response.data.token
                                    })
                                });
                                return
                            }

                            this.isChecking = false;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                console.log("token not exist in local storage");

                let token =
                    typeof this.$route.query.token === "undefined"
                        ? false
                        : this.$route.query.token;
                if (token) {
                    console.log("token in  query");
                    axios
                        .get(`respondent/survey/auth-respondent?token=${token}`)
                        .then(response => {
                            // console.log(response.data);
                            if (response.data.status == "exist") {
                                console.log("token is exist in database");
                                localStorage.token_respondent =
                                    response.data.token;
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
                                console.log("token not exist in database");
                                localStorage.token_respondent =
                                    response.data.token;
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
                    console.log("token not in query");
                    axios
                        .get(`respondent/survey/auth-respondent`)
                        .then(response => {
                            console.log("get new token from server");
                            // console.log(response.data);
                            localStorage.token_respondent = response.data.token;
                            if (this.$route.name !== "SocialData") {
                                console.log("route name not social data");
                                if (this.$route.name !== "Welcome") {
                                    console.log("route name not welcome");
                                    this.handleRoute(
                                        response.data.token,
                                        "Welcome"
                                    );
                                    return;
                                }
                            }

                            this.$router.replace({
                                query: Object.assign({}, this.$route.query, {
                                    token: response.data.token
                                })
                            });
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
