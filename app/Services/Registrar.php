<?php namespace Glitter\Services;

use Glitter\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
            'username' => 'required|max:100|unique:users',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
            'username' => $data['username'],
            'avatar' => $this->getAvatar()
		]);

        Redis::set($data['username'] . ':exists', true);
	}

    /**
     * Just get a random avatar
     */
    private function getAvatar()
    {
        $avatars = [
            'image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhYaKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wAARCABkAGQDAREAAhEBAxEB/8QAHAAAAgMBAQEBAAAAAAAAAAAABgcDBAUCAQAI/8QARhAAAgECBAQDBAQLAw0AAAAAAQIDBBEABRIhBhMxQSJRYQcUMnEIFWKBFyNCUpGho7HBw9EWM+EYJCY0NkNTVIOSotPx/8QAGgEAAgMBAQAAAAAAAAAAAAAAAwQAAQIFBv/EACkRAAICAgEDAwQDAQEAAAAAAAABAhEDIRIEEzEiQWEFMoHBQlFxFCP/2gAMAwEAAhEDEQA/AFJNDGtninWSI9R3xzGxJugpTg2mrcqgzDLJgrEfjAT0OF1lalTB8jLpEWQPHVwPJyiQrnpismeMS3PR97g80JPLIUna2ALJu2B57C0cCR1vDKpQSsMzkXWI3Hhba9gfM/LBMcXz53o6cOik4c0AVJlc9OsqTKUMfxBtiDhl5FKQnJ7I0uFZlUm3e2wwWmTyWqFY65WSWwdT1GFM3PG7F8lxYUQ8UVNPFT5LTxqYGsmphcscYcXON+5mnJWyDj3g6fLViquSCzJqYJ2xnp8s4+iTLwZHF0wbpMqrQ1PM8J93NjrU9MNdxbVjmSa8GpxPA09EEhBYgWta+M4JVIDCWxacV0stNFRCYWZte3/bjpYpcmxvC7bGpxblOV+60jUkZSUfGyC2OfjzKXkBZ1Q5pDlnDjU8blpmY3wLLjt2mCasyKnP1ESxqLt5W64F/wAzk7ZlxZs8JV0T1sMdRIU5rWUdd/LE7acuJmMbkkNPL5RNKyx7FSQMMqHHR6zHUYoFvaTliwxfWNPAWWrYiXT+TKBv+nr+nAaamcbrumcJco+GBXDVXHEJaWoi1R1B0MCvw/fg+ST9mc/wacWU5OagpQ1TLVobctvysBnya2YcXLQxuH8kjXJ6dKqihNSj8zWw3B7Yzig0tnV6T6ZaUsgNcd1VXFmsiM7tHJCNibgdrfqwtNOE7Od1+GODNUQU4Or6p6Orhm8UIchb9sN51FNUDyu6YSZXlT1qEJII5j8IYXvjEZcTPLj5Ft7cMtmy9smFRp5ria5Ate2j+uOj0U+XL8DnST5WEMud02Y0bLFZde5HrhHg4vwSig+XCPLzVq+tL2YY15ZigfYQR1YlB1owxqXKUaRU1aDbgPL4M0zmnL3VYrOg82BFsL424TqXknTRfNBxFmHu+c1NJGwMPViy2Iw9JpHpEElJV0i5Y8MirURFgdTi926A2wnOX9B1GMvuVnpyLJJo5o/c0jVz8UZ3+eBtsFPo8M/KM3LOFcnoKr36liLVDfAXOrTbv88EhNvRiPRYsb5IKEkEVIpjKlu4ww1QxFf0A3tArcsq6qTL1lC5hTookFupYBrf+WFM2vJ5f6o7zsXuTVD0zMiKLRt4tu+JkT0xOUXdm1VZxVo8U8DaXQg7DAoW2X94G+3bOhnFPw4Wj0TRLOH3635f9Mdb6eq5fj9jfRRrkD1LTz0k0pW5CWuMTuRkgumg6oIauXJ5Gp4xKsaanS+9j3wK4rZigRShrDU6IaUhS1wzdMR5MbW2SkGnAtTU++RRzRGJkc3lHe3bAHii580zXTx/9UHc1LRVNW7a/HYs5G5NuuCO5Oj0CqKJskznKa+tOWUfMZ08bh1tdbdf1d98XLA4rZlZ03SCOiyxuVVSSs/IjGnY2B/wwDjfgO5aI350EwkiYPAPCGQ3B+WMpcWXdo6y6nmqeIEWRWFI9iWc9B3OGlJMw24xsTueVUVbxHW5hCrDmzsSwFgTfC2ZWqPJdS3JtsryxGnzHmrciVAW9T54Ap9yGzEn7Hc9XKW0RABO+2C40orZqMdAF7SonQZbI7BhJzLW7fBjp9E0+VfH7HOnVWNVeGEjlknR0eOQki/7scqbqmmUfZRl0lLU1Molcc4iMKBtb1xePqFKNMot6EAEBTS2ogYXyS3SM0XKagjp6cMhtITYj+OGMU7SQXBqaOsuzOGhqWVpVYOpSW4/JOxGGtxdo7bqWmauUZHQ8P1VNWUJqBFUyNIVla0epwAW6+QwaWeU40zEMMIu0FXES1md8PPlmSSpBUX5rSPYhgBsPLqQd9ja2MYJxxv1IJmxylHTMThXKqrI+G1pK2qjfMNYfSo1DpvcnzxXU5IT+1FdNGcfuDPLIzUZBVyuoBZGiUjYqSLG2Fk+Ows1z9KFo/BpeSaFWUG+tV6ajgbm8mjg9Z0/CWy2vDmX1WSqahDHVRHSfO2FccnG7FJxtg3m+UpA8JgQCNT4++2J3XbNqItPbNTwU8WSe7agjc7Y/wDT/rjsfTJW5/j9h8Kqxk1FRJpbkNdbawuOUlJrRlkNJmU3vZjlj1DRdvT1xFGT8mS1KxLEHcW2bvY98Dk2pEZaoyI5kVwzqADqPbGsMnyNY0+RZaiU1Rlpwlg3iDDr8sdyMU9nRcnVG1mGbvm2XNlvJikR9hzAPCR0INtiME9NFxk7Dz2ewTRQLG9GqIgtqC31XHW+MKEbs3PLJlXMuH6tc1IoVmOp/wDeWIt8/LCmTE+Wg+PMq2aNeRl0MNEFGo7tY7E98ByLjoYxLk+SB/iKnZadpYh4gLj54WlFy8AetwqeNsX9ZmDlAgdkmOzLfY4xmSS5Hn5R2SmqilpRzCBIFIYjC2JpNuyxRe25bLkjatQbn29P7vHe+k/zf+fsJi9w4EpirRGygAAqPtemEYY3GRk9/Fisjki1BytmUm2Ki3G0yG3U8iKKmSKIgsL3O4PmL4nUcdNFMlo5GdeXIFDHcW/djeFxlpBcSuRepqWYyytfw3PTHVxrQ7NUEmTcPtIpkKgN1FxjbiYGBlay5fRqzzARqBe3bGXUS0uREc9Z6nwHUq9ztfC8sy9hqGHRj5j/AJxUmoBGm/fCWR8nY9jXFUWamm95ytwNmKkA/dikjOTcWhLNldXmWZVUMP42Wl1DSp0tYYjx800jzmRepoxZJJYZuUFYD4W9cA7aitow0AXtiZdGTKpPhE1wex8GOp9K/n+P2ExLyMvMqmOsQF4YoZ6dgixJsz/bwo3WzB4lMZUaRWWUquqw2IwHm3KyUSLmCyZYEeE6VbUN97+mIpJ+mRKsvZbWRGWKAggsNQZuoPkcHhCMXoJD0tM3MvrORVDWNV+iE9/PHQhL2HnvYwcuktRR7HUq3IHmcHu0CZUrMya/u1yR0OFMs9UM4oaJKSIFgzne3TywpVjKZ3WgCJY1bYtvYYy0Gizep6Zo6IBGPTbV8sajHRiUvVQk+IYa3L84qM0oUcVUMl3Cdxfy74qnF2cLNGpsr10lLmVDzmplo6r4mTuSetvTF5OMl6Qd0J/2vMWp8luBsZwD6fi8O/TX9y/z9hIMZFYOdHFLL8C3CPbcN1IvjnqSapgzj4F1ghi1xpBsQcWopojJA6sJBAyyOouY32OK7fIiVlc1aKZuXcVUDiNojvt6HFTUlE0FGWlJJI5JG8QFzfubYc6aVxp+RzHK1QwcrrSU0ooNhY77Xww5tKjairKlTHI1TzAl9fl92FpbYeLSLKVO3W5A8QHX7sYaoImmQLI02YQxFxe42Y74G0FiMswWy4E7gLc/owdY/ToSeSpn584tzh5szf6vLtu0ciKljt0/jgTTejn5XcmDqajA6zTHUtmcOviAwKdfajCW9i29r8kDjKBScwwgS2Z7bnweWH/pv8/x+wkUk9DA4fraP3TkZhBLKznUp5wRLDta17+t8Alii9oGkd6C0llVUXryy5uB29cBl6HsujUp4IalKddA96S6PY+JrG6tfv5YjnH2K17GbW0YjqqiVgryM2tuX8Sm/fEco1bIjqheZYZQuoujButsFxSrwMYHugz4a4gWJVWWI3I7dsNxaGZJphkM2p4aLVLbURt8saUF5M2BdBmdQ9bK6EaDISLnthbK96GMOwp4eR569WenJBOoyNYi2F9tjLVIK+N8+GQcF1VUTplkXlxL1uT/AAthu6js52aSPzhI61bu0h5dS/jIUm1/64S5Si7EZL3MpMxkklkRkY3Ogm/bGml9xTToEvaqIVgydYOi84db/mf44c+nO3P8fs3BBZT5FnOaLSiOlleAt12UoL9d98ahjojgwlrMgzaqzidoqeaRYiI45JQAWTYdvljEsVu6CRjJGp9U18FXJJUU4gRnuhV7aB2scYWB3pEeNskOXzSyyVFVOsr3HMduret+5xiPSybbkV2meR5OEczROTH+aBt3wWPTOO7NwhxdmlklPTyu4kXUD4bDbfApXFnQS5KzHleZM4qaGWdhTILglvlYYag20LzVM08sgV5I9Hwrtv3wpm8jOEanCGVSvQs6amDEKFPQDviYccpF5siiZntApaTN8xhoq0yCOlFlUSBQT+cPXDrx6piMqmYVHwFkcVpIYmlJ8R5kl7+ZuDjHajVMz20X24HyDWsv1SiFrHwsW+/Y4vtw/ovihJ/SqyOgyY8Lmgp44WmFTr0d9PKt+84Z6eKjdGJpIaLZdLNODSoUIN1ZRpHXywO6Nmm0NW0b+81SRFDp3XxH9GKbNlKoRWFp53lC/m2F8VZDGnkWJyqQXTuS++LTKIvrQvLS5bHSsschIaTspJ6nG/YzQZR8KrBR00lFI7vIbXtcX9fLod8K5Md+BnHNLyLDjamYcVR5e0pjqDYeHuTgmOLijGSSbGRwnwjNUlC1SqWFgoW9jgcuncns2syig7zyb+zeW5ZEOYTz1BMakg+d7drYYx4+2gDnzbbMvjBafOZ4amKyOisDzI9iO3/zGpuyoqjAyyjaB250agarm3QfLfGDRbivVNMlLT1aslm1bi59N8UQRf0rdduFuZBJF/rVuZa5/ucHwe4LIUX9v0jWA4d0qNrCut/LxOz8k7hEfbuxvfh82I/54f8ArxOz8k7hz+HGNk0ycNu3qMwt/LxOz8k7hH+GulK6W4VRrm5vXdf2e2J2fkncIvwyUmoH+y52OxGYWIHz5eJ2fkncNCD6QVbTUxggymYJawDVytbe/wDwvXE7PyTuAzN7ToZ80OZVGT1EtdqDiV64GxHTbl4nZ+SdwKsk+kTmGVSFo8jhk6W1VHTr9j1xfa+Sc/g2q76ThzCKBa3hLmNExYEZlp6+nKxbx37lKdEUn0lInP8AscpH2syv/KxXa+S+4cD6SUYA/wBDY9Q6H6xO37PE7PyTuH3+Uq6ppj4WEdzclcwtf9lidn5J3Bc+1n2kH2gnKycr9wNDzd/eedzNej7K2to/XjcIcTMpcj//2Q==',
            'image/jpeg;base64,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',
            'image/jpeg;base64,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',
            'image/jpeg;base64,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',
            'image/jpeg;base64,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',
            'image/jpeg;base64,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'
        ];

        return $avatars[array_rand($avatars)];
    }
}
