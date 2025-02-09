import { Route, Routes } from 'react-router-dom';
import routes from './routes';

const generateRoutes = (routes) =>
    routes.map(({ path, element, children }, index) => (
        <Route key={index} path={path} element={element}>
            console.log(path)
            {children && generateRoutes(children)}

        </Route>
    ));


const AppRoutes = () => <Routes> {generateRoutes(routes)}</Routes>;

export default AppRoutes;