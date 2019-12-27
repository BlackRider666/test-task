import Home from "./components/pages/home";
import Login from "./components/auth/login";
import Serial from "./components/pages/serial";
import Sezon from "./components/pages/sezon";
import Epizod from "./components/pages/epizod";
import AdmSerial from "./components/admin/serials";
import AdmSezon from "./components/admin/sezons";
import AdmEpizod from "./components/admin/epizods";

export default [
	{
		path: '/',
		component: Home,
		name:'home'
	},
	{
		path: '/login',
		component: Login
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
		component: AdmSerial
	},
	{
		path: '/admin/serial/:id/sezons',
		component: AdmSezon,
		name:'admin_sezons',
		props:true,
	},
	{
		path: '/admin/sezon/:id/epizods',
		component: AdmEpizod,
		name:'admin_epizods',
		props:true,
	},
];