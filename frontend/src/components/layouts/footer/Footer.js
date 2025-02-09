import React from 'react';
import SocialIcons from './SocialIcons';
import { Container, Row } from 'react-bootstrap';

import Copyrights from './Copyrights';
import FooterLinkItems from './FooterLinkItems';

function Footer() {
    return (
        <footer
            className="text-light py-4 border-top"
            style={{ background: 'var(--primary-color)' }}
        >
            <Container>
                <Row className="align-items-center">
                    <FooterLinkItems />
                    <SocialIcons />
                </Row>
                <Copyrights />
            </Container>
        </footer>
    );
}

export default Footer;
