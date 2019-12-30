import Home from "./components/pages/home";
import Login from "./components/auth/login";
import Logout from "./components/auth/logout";
import Serial from "./components/pages/serial";
import Sezon from "./components/pages/sezon";
import Epizod from "./components/pages/epizod";
import AdmSerial from "./components/admin/serials";
import AdmSezon from "./components/admin/sezons";
import AdmEpizod from "./components/admin/epizods";
import NotAdmin from "./components/admin/notAdmin";

export default [
	{
		path: '/',
		component: Home,
		name:'home'
	},
	{
		path: '/login',
		component: Login,
		name: 'login',
		meta:{
			requiresVisitor: true,
		}
	},
	{
		path: '/logout',
		component: Logout,
		name:'logout',
		meta:{
			requiresAuth: true,
		}
	},
	{
		path: '/serial/:id',
		component: Serial,
		name:'serial_show',
		props:true,
	},
	{
		path: '/sezon/:id',
		component: Sezon,
		name:'sezon_show',
		props:true,
	},
	{
		path: '/epizod/:id',
		component: Epizod,
		name:'epizod_show',
		props:true,
	},
	{
		path: '/admin',
		component: AdmSerial,
		name:'admin',
		meta:{
			requiresAuth: true,
			requiresAdmin:true
		}
	},
	{
		path: '/admin/serial/:id/sezons',
		component: AdmSezon,
		name:'admin_sezons',
		props:true,
		meta:{
			requiresAuth: true,
			requiresAdmin:true
		}
	},
	{
		path: '/admin/sezon/:id/epizods',
		component: AdmEpizod,
		name:'admin_epizods',
		props:true,
		meta:{
			requiresAuth: true,
			requiresAdmin:true
		}
	},
	{
		path: '/not-admin',
		component: NotAdmin,
		name:'not_admin',
		meta:{
			requiresAuth: true,
		}
	},
];