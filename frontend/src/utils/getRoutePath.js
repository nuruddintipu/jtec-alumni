import routes from '../routes/routes';

const combinePaths = (parentPath, childPath) => {
    const combinedPath = `${parentPath}${childPath ? `/${childPath}` : ''}`;
    return combinedPath.replace(/\/+/g, '/').replace(/\/$/, '');
}

const getRoutePath = (routeName, routeList = routes, parentPath = '') => {
    for(const route of routeList) {
        const currentPath = combinePaths(parentPath, route.path);

        if (route.name === routeName) {
            return currentPath || '/';
        }

        if(route.children) {
            const childPath = getRoutePath(routeName, route.children, currentPath);
            if(childPath) {
                return childPath;
            }
        }

        return null;
    }
};

export default getRoutePath;