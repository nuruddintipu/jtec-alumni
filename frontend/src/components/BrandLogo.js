import logoNavyBlue from '../assets/logo/saa-logo.png';
import logoWhite from '../assets/logo/saa-logo-white.png';
import { Image } from 'react-bootstrap';

const BrandLogo = ({ isScrolled }) => {
    const logoSrc = isScrolled ? logoWhite : logoNavyBlue;

    return (
        <Image
            src={logoSrc}
            alt={'JTec Alumni'}
            width={'60'}
            height={'60'}
        />
    );
};

export default BrandLogo;