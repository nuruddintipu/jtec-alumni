import { Nav } from 'react-bootstrap';
import NamedRouteLink from '../../NamedRouteLink';

const NavItem = ({ routeName, text, isScrolled}) => {
    return (
        <Nav.Link
            as={NamedRouteLink}
            routeName={routeName}
            style={{ color: isScrolled ? 'white' : 'black' }}
        >
            {text}
        </Nav.Link>
    );
};

export default NavItem;