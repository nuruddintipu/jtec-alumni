import NavItem from '../layouts/navbar/NavItem';
import ButtonPrimary from './ButtonPrimary';
import NamedRouteLink from '../NamedRouteLink';

const LoginButton = ({ isAuthenticated, isOnNavbar = false, isScrolled, className = '', ...props}) => {
    const buttonText = isAuthenticated ? 'Dashboard' : 'Login';
    const routeName = isAuthenticated ? 'DASHBOARD' : 'LOGIN';

    return isOnNavbar ? (
        <NavItem
            routeName={routeName}
            text={buttonText}
            isScrolled={isScrolled}
            {...props}
        />
    ) : (
        <ButtonPrimary
            buttonText={buttonText}
            as={NamedRouteLink}
            routeName={routeName}
            {...props}
        />
    )
};

export default LoginButton;