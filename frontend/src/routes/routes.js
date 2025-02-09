import Homepage from '../pages/homepage/Homepage';
import MainLayout from '../components/layouts/MainLayout';



const mainLayoutRoutes = [
    {
        path: '',
        name: 'HOMEPAGE',
        element: <Homepage />
    }
];

const routes = [
    {
        path: '/',
        element: <MainLayout />,
        children: mainLayoutRoutes
    }
];

export default routes;