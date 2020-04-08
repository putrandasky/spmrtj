import Vue from 'vue';
import Router from 'vue-router';

import Layout from '@/admin/components/Layout/Layout';
import Login from '@/admin/pages/Login/Login';
import ErrorPage from '@/admin/pages/Error/Error';
// Core
import TypographyPage from '@/admin/pages/Typography/Typography';

// Tables
import TablesBasicPage from '@/admin/pages/Tables/Basic';

// Maps
import GoogleMapPage from '@/admin/pages/Maps/Google';

// Main
// import AnalyticsPage from '@/admin/pages/Dashboard/Dashboard';
import Dashboard from '@/admin/pages/Dashboard/Dashboard2';

// Charts
// import ChartsPage from '@/admin/pages/Charts/Charts';

// Ui
// import IconsPage from '@/admin/pages/Icons/Icons';
import NotificationsPage from '@/admin/pages/Notifications/Notifications';


Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login,
    },
    {
      path: '/error',
      name: 'Error',
      component: ErrorPage,
    },
    {
      path: '/app',
      name: 'Layout',
      component: Layout,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard,
        },
        {
          path: 'typography',
          name: 'TypographyPage',
          component: TypographyPage,
        },
        // {
        //   path: 'components/icons',
        //   name: 'IconsPage',
        //   component: IconsPage,
        // },
        {
          path: 'notifications',
          name: 'NotificationsPage',
          component: NotificationsPage,
        },
        // {
        //   path: 'components/charts',
        //   name: 'ChartsPage',
        //   component: ChartsPage,
        // },
        {
          path: 'tables',
          name: 'TablesBasicPage',
          component: TablesBasicPage,
        },
        {
          path: 'components/maps',
          name: 'GoogleMapPage',
          component: GoogleMapPage,
        },
      ],
    },
  ],
});
