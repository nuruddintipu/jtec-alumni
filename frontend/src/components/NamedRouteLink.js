import { Link } from 'react-router-dom';
import getRoutePath from '../utils/getRoutePath';

const NamedRouteLink = ({ routeName, children, ...props}) => {
    const path = getRoutePath(routeName);
    return (
        <Link to={path} {...props}>{children}</Link>
    );
};

export default NamedRouteLink;