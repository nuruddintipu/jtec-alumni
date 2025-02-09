import { useState, useEffect } from 'react';

const useScrollEffect = () => {
    const [isScrolled, setIsScrolled] = useState(false);
    const [navbarBackground, setNavbarBackground] = useState('#E6E6E6FF');
    const handleScroll = () => {
        if (window.scrollY > 20) {
            setIsScrolled(true);
            setNavbarBackground('#12293d');
        } else {
            setIsScrolled(false);
            setNavbarBackground('#E6E6E6FF');
        }
    };

    useEffect(() => {
        window.addEventListener('scroll', handleScroll);
        return () => {
            window.removeEventListener('scroll', handleScroll);
        };
    }, []);

    return { isScrolled, navbarBackground };
};

export default useScrollEffect;
