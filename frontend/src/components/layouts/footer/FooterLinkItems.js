import { Col } from 'react-bootstrap';
import NamedRouteLink from '../../NamedRouteLink';

const FooterLinkItems = () => {
    return (
        <Col md={6} className={'text-center mb-3 mb-md-0 text-md-start'}>
            <NamedRouteLink routeName={'/about'} className='text-decoration-none text-light d-block mb-1'>About</NamedRouteLink>
            <NamedRouteLink routeName={'/contact'} className='text-decoration-none text-light d-block mb-1'>Contact</NamedRouteLink>
        </Col>
    );
};

export default FooterLinkItems