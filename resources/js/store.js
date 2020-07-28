import Vuex from "vuex";
// Vue.use(Vuex)

var url = "/api/global";

var state = {
  document_title: "Faceper",
  user: {
    id: null,
    email: null
  },
  env: {
    website_base: ".faceper.co",
    email_domain: "@faceper.co",
    app_env: "production",
    locale: "en_US",
    fb_app_id: 716571212447026
  },
  experiments: []
};

var mutations = {
  boot(state) {
    if (exceptURI.includes(window.location.pathname) === false) {
      axios
        .get(url)
        .then(response => {
          Object.assign(state.user, response.data.user);
          // Object.assign(state.store, response.data.store);
          Object.assign(state.env, response.data.env);
          // intercom.boot(response.data);
          Raven.setUserContext({
            email: state.user.email,
            // store_url: state.store.url,
            // locale: state.user.locale
          });
          // hj("tagRecording", [
          //   "storeId-" + state.store.id,
          //   "storeUrl-" + state.store.url,
          //   "planId-" + state.store.plan_id,
          //   "billingCycle-" +
          //     (state.store.subscription.cycle > 0
          //       ? state.store.subscription.cycle
          //       : 0),
          //   "storeCreatedAt-" +
          //     window._moment(state.store.created_at).format("YYYYMMDD"),
          //   "userCreatedAt-" +
          //     window._moment(state.user.created_at).format("YYYYMMDD")
          // ]);

          /*
            //Removed as of new survey form
            if (response.data.admin_first_seen_at_redirection != null) {
              // "/settings/domain" - Redirected from CP
              // "/settings/domain/new" - Redirected from Subscription
              // "^/settings/domain/[0-9]+$" - Redirected from email (cancel Auto-renew)
              var domainRelatedURI = "/settings/domain";
              if (window.location.pathname.indexOf(domainRelatedURI) != 0) {
                if (
                  response.data.admin_first_seen_at_redirection == "non_owner" ||
                  response.data.admin_first_seen_at_redirection ==
                    "existing_owner"
                ) {
                  window.location.href = "/start/introduction";
                } else if (
                  response.data.admin_first_seen_at_redirection == "new_owner"
                ) {
                  window.location.href = "/start";
                }
              }
            }
          */

          // setLocale(state.user.locale);

        })
        .catch(e => {
          if (e.response.status == 401) {
            window.location.href =
              "/login"
          }
        });
    } else {
      // axios
      //   .get("/_api/public")
      //   .then(response => {
      //     if (response.data.locale) {
      //       state.env.locale = response.data.locale;
      //       setLocale(response.data.locale);
      //       Object.assign(state.env, response.data.env);
      //     }
      //   })
      //   .catch(e => {
      //     console.log(e);
      //   });
    }
  },
  update(state) {
    // if (exceptURI.includes(window.location.pathname) === false) {
      axios
        .get(url)
        .then(response => {
          Object.assign(state.user, response.data.user);
          // Object.assign(state.store, response.data.store);
          Object.assign(state.env, response.data.env);
          // intercom.update(response.data);
          // Raven.setUserContext({
          //   email: state.user.email,
          //   store_url: state.store.url,
          //   locale: state.user.locale
          // });

          // setLocale(state.user.locale)
        })
        .catch(e => {
          // console.log(e);

          if (e.response.status == 401) {
            window.location.href =
              "/login";
          }
        });
    // } else {
      // axios
      //   .get("/_api/public")
      //   .then(response => {
      //     if (response.data.locale) {
      //       state.env.locale = response.data.locale;
      //       setLocale(response.data.locale);
      //       Object.assign(state.env, response.data.env);
      //     }
      //   })
      //   .catch(e => {
      //     console.log(e);
      //   });
    // }
  }
};

export default new Vuex.Store({
  state,
  mutations
});
