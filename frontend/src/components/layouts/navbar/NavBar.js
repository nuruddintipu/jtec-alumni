import './navbar.css';
import { Container, Nav, Navbar } from 'react-bootstrap';
import useNavbarScrollEffect from '../../../hooks/useNavbarScrollEffect';
import NamedRouteLink from '../../NamedRouteLink';
import BrandLogo from '../../BrandLogo';
import NavItem from './NavItem';
import NavDropdownMenu from './NavDropdownMenu';
import LoginButton from '../../buttons/LoginButton';

const NavBar = () => {
    const {isScrolled, navbarBackground} = useNavbarScrollEffect();

    const aboutDropdownItems = [
        { routeName: 'FOUNDING_STORY', text: 'Founding Story' },
        { routeName: 'CONSTITUTION', text: 'Constitution' },
        { routeName: 'ABOUT', text: 'About Us' },
    ];

    const alumniDropdownItems = [
        { routeName: 'ALUMNI', text: 'Alumni' },
    ];


    return (
        <Navbar
            variant={isScrolled ? 'dark' : ''}
            expand={'lg'}
            sticky={'top'}
            className = 'border-bottom'
            style={{
                backgroundColor: navbarBackground,
                transition: 'background-color 0.3s ease-in-out',
                boxShadow: navbarBackground === 'transparent' ? 'none' : '0px 2px 5px #000'
            }}
        >
            <Container>
                <Navbar.Brand as={NamedRouteLink} routeName={'HOME'}>
                    <BrandLogo isScrolled={isScrolled} />
                </Navbar.Brand>

                <Navbar.Toggle aria-controls="basic-navbar-nav" style={{borderColor: isScrolled ? 'white' : 'black'}} />

                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className={'ms-auto text-dark'}>
                        <NavItem routeName={'HOME'} text={'Home'} isScrolled={isScrolled} />
                        <NavDropdownMenu title={'About'} items={aboutDropdownItems} isScrolled={isScrolled} />
                        <NavDropdownMenu title={'Alumni'} items={alumniDropdownItems} isScrolled={isScrolled} />
                        <LoginButton isOnNavbar={true} isScrolled={isScrolled}/>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
}
export default NavBar;