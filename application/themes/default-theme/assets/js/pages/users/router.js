import group from './group/router';
import user from './user/router';

const Component = {
	template: '<router-view></router-view>'
};

export default {
	path: '/users',
	redirect: '/dashboard',
	meta: {
		title: 'Users'
	},
	component: Component,
	children: [
		user, group
	]
}