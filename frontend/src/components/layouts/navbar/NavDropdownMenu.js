import { NavDropdown } from 'react-bootstrap';
import NamedRouteLink from '../../NamedRouteLink';

const NavDropdownMenu = ({ title, items, isScrolled }) => {
    const dropdownClass = isScrolled ? 'navbar-dropdown-scrolled' : 'navbar-dropdown-default';

    return (
        <NavDropdown title={title} id="basic-nav-dropdown" className={dropdownClass}>
            {items.map((item, index) => (
                <NavDropdown.Item as={NamedRouteLink} routeName={item.routeName} key={index}>
                    {item.text}
                </NavDropdown.Item>
            ))}
        </NavDropdown>
    );
};

export default NavDropdownMenu;