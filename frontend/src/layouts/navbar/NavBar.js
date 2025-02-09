import { useEffect, useState } from 'react';
import './navbar.css';
import { Container, Image, Nav, Navbar } from 'react-bootstrap';

const brandLogoNavyBlue = require('../../assets/logo/saa-logo.png');
const brandLogoWhite = require('../../assets/logo/saa-logo-white.png');

const NavBar = () => {
    const [scrolled, setScrolled] = useState(false);
    const [navbarBackground, setNavbarBackground] = useState('--secondary-color');
    const [logo, setLogo] = useState(brandLogoNavyBlue);


    const handleScroll = () => {
        if(window.scrollY > 20){
            setScrolled(true);
            setNavbarBackground('--primary-color');
            setLogo(brandLogoWhite);
        } else {
            setScrolled(false);
            setNavbarBackground('--secondary-color');
            setLogo(brandLogoNavyBlue);
        }
    };

    useEffect(() => {
        window.addEventListener('scroll', handleScroll);
        return () => {
           window.removeEventListener('scroll', handleScroll);
        };
    }, []);

    const dropdownClass = scrolled ? 'navbar-dropdown-scrolled' : 'navbar-dropdown-default';

    return (
        <Navbar
            variant={scrolled ? 'dark' : ''}
            expand={'lg'}
            className={'border-bottom'}
            style={{
                backgroundColor: navbarBackground,
                transition: 'background-color 0.3s ease-in-out',
                boxShadow: navbarBackground === 'transparent' ? 'none' : '0px 2px 5px #000'
        }}
        >
            <Container>
                <Navbar.Brand href="/">
                    <Image
                        src={logo}
                        alt="SAA Logo"
                        width="60"
                        height="60"
                    />
                </Navbar.Brand>

                <Navbar.Toggle
                    aria-controls="basic-navbar-nav"
                    style={{
                        borderColor: scrolled ? 'white' : 'black'
                    }}
                />


                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className={'ms-auto text-dark'}>
                        <Nav.Link href="/">Home</Nav.Link>
                        <Nav.Link href="/about">About</Nav.Link>
                        <Nav.Link href="/contact">Contact</Nav.Link>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
}

export default NavBar;