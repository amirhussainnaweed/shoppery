import Breadcrumb from '@/Components/Breadcrumb';
import MainLayout from '@/Components/Layout/MainLayout';
import { Head, router } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { useState } from 'react';
import toast, { Toaster } from 'react-hot-toast';

export default function Cart(props) {
    const cartItems = props.cartItems || props.CartItems || [];
    const [coupon, setCoupon] = useState('');

    const placeholderImage = 'https://via.placeholder.com/150?text=Product';

    const increaseQuantity = (cartItemId, currentQuantity) => {
        router.patch(
            `/cart/item/${cartItemId}`,
            { quantity: currentQuantity + 1 },
            { preserveScroll: true }
        );
    };

    const decreaseQuantity = (cartItemId, currentQuantity) => {
        if (currentQuantity > 1) {
            router.patch(
                `/cart/item/${cartItemId}`,
                { quantity: currentQuantity - 1 },
                { preserveScroll: true }
            );
        }
    };

    const removeProduct = (cartItemId) => {
        router.delete(`/cart/item/${cartItemId}`, {
            preserveScroll: true,
            onSuccess: () => toast.success('Cart Item Removed'),
        });
    };

    const total = cartItems.reduce((sum, item) => {
        const productObj = item.product || item.Product || {};
        const price = Number(productObj.price ?? item.price ?? 0);
        return sum + item.quantity * price;
    }, 0);

    const returnToShop = () => {
        router.visit('/shop');
    };

    const proceedToCheckout = () => {
        router.visit('/checkout');
    };

    const updateCart = () => {
        toast.success('Cart Updated Successfully');
    };

    const applyCoupon = () => {
        if (coupon.trim().toUpperCase() === 'SAVE20') {
            toast.success('Coupon Applied Successfully');
        } else if (coupon.trim() === '') {
            toast.error('Please Enter Your Coupon');
        } else {
            toast.error('Invalid Coupon');
        }
    };

    const buttonAnimation = {
        whileHover: { scale: 1.05, y: -2 },
        whileTap: { scale: 0.95 },
        transition: { duration: 0.2 },
    };

    return (
        <MainLayout>
            <Toaster />
            <Head title="Cart" />
            <Breadcrumb
                items={[
                    {
                        label: 'Shopping cart',
                        href: '/cart',
                    },
                ]}
                backgroundImage="/images/breadcrumbs.png"
            ></Breadcrumb>
            {/* Container */}
            <section className="px-4 py-10 mx-auto max-w-7xl">
                <h1 className="mb-10 text-center text-2xl font-semibold leading-[120%] text-[#1a1a1a] sm:text-3xl md:text-4xl">
                    My Shopping Cart
                </h1>
         
                <div className="grid grid-cols-1 gap-6 lg:grid-cols-3">
                   
                    <div className="lg:col-span-2">
                        <div className="overflow-hidden border rounded-2xl lg:col-span-2">
                            
                            <div className="hidden p-5 border-b gap-14 bg-gray-50 md:grid md:grid-cols-5">
                                <p className="text-sm font-medium leading-[120%] tracking-[3%] text-[#808080] md:col-span-2">
                                    PRODUCT
                                </p>
                                <p className="text-sm font-medium leading-[120%] tracking-[3%] text-[#808080]">
                                    PRICE
                                </p>
                                <p className="text-sm font-medium leading-[120%] tracking-[3%] text-[#808080]">
                                    QUANTITY
                                </p>
                                <p className="text-sm font-medium leading-[120%] tracking-[3%] text-[#808080]">
                                    SUBTOTAL
                                </p>
                            </div>
                            {/* Product Row */}
                            {cartItems.length === 0 ? (
                                <div className="p-10 text-center text-gray-500">
                                    Your cart is empty.
                                </div>
                            ) : (
                                cartItems.map((item) => {
                                    const productObj = item.product || item.Product || {};
                                    const price = Number(productObj.price ?? item.price ?? 0);
                                    const itemSubtotal = price * item.quantity;

                                    return (
                                        <div
                                            key={item.id}
                                            className="flex flex-col gap-3 border-b lg:ml-[-70px] lg:p-2 md:grid md:grid-cols-5 md:items-center"
                                        >
                                          
                                            <div className="flex flex-col items-center gap-4 sm:flex-row sm:justify-center md:col-span-2">
                                                <img
                                                    src={placeholderImage}
                                                    alt="Product Placeholder"
                                                    className="object-contain w-24 h-24 sm:h-32 sm:w-32"
                                                />
                                            </div>
                                            <div className="flex justify-between p-3">
                                                <p className="text-sm font-medium leading-[120%] tracking-[3%] text-[#808080] md:hidden">
                                                    Price
                                                </p>
                                                <p className="font-normal leading-[150%] text-[#1A1A1A]">
                                                    ${price.toFixed(2)}
                                                </p>
                                            </div>
                                            <div className="flex justify-between p-3">
                                                <p className="text-sm font-medium leading-[120%] tracking-[3%] text-[#808080] md:hidden">
                                                    Quantity
                                                </p>
                                                <div className="flex items-center gap-2 px-3 py-2 border rounded-full w-fit">
                                                    <motion.button
                                                        whileHover={{ scale: 1.15 }}
                                                        whileTap={{ scale: 0.95 }}
                                                        transition={{ duration: 0.2 }}
                                                        onClick={() => decreaseQuantity(item.id, item.quantity)}
                                                    >
                                                        <img
                                                            src="/images/Minus.svg"
                                                            alt="minus"
                                                            className="w-8 transition-opacity hover:brightness-90"
                                                        />
                                                    </motion.button>
                                                    <p>{item.quantity}</p>
                                                    <motion.button
                                                        whileHover={{ scale: 1.15 }}
                                                        whileTap={{ scale: 0.95 }}
                                                        transition={{ duration: 0.2 }}
                                                        onClick={() => increaseQuantity(item.id, item.quantity)}
                                                    >
                                                        <img
                                                            src="/images/Plus.svg"
                                                            alt="plus"
                                                            className="w-8 transition-opacity hover:brightness-90"
                                                        />
                                                    </motion.button>
                                                </div>
                                            </div>
                                            <div className="flex justify-between p-3">
                                                <p className="text-sm font-medium leading-[120%] tracking-[3%] text-[#808080] md:hidden">
                                                    Subtotal
                                                </p>
                                                <div className="flex items-center gap-6 md:ml-6">
                                                    <p className="font-normal leading-[150%] text-[#1A1A1A]">
                                                        ${itemSubtotal.toFixed(2)}
                                                    </p>
                                                    <motion.button
                                                        whileHover={{ scale: 1.2 }}
                                                        whileTap={{ scale: 0.95 }}
                                                        transition={{ duration: 0.2 }}
                                                        onClick={() => removeProduct(item.id)}
                                                        className="shrink-0"
                                                    >
                                                        <img
                                                            src="/images/remove.svg"
                                                            alt="remove"
                                                            className="w-6 transition-opacity shrink-0 hover:brightness-50"
                                                        />
                                                    </motion.button>
                                                </div>
                                            </div>
                                        </div>
                                    );
                                })
                            )}

                            <div className="flex flex-col justify-between gap-4 p-4 sm:flex-row">
                                <motion.button
                                    onClick={returnToShop}
                                    className="rounded-full bg-[#F2F2F2] px-8 py-3 text-sm font-semibold leading-[120%] text-[#4D4D4D] transition-colors hover:bg-gray-200"
                                    {...buttonAnimation}
                                >
                                    Return to Shop
                                </motion.button>

                                <motion.button
                                    {...buttonAnimation}
                                    onClick={updateCart}
                                    className="rounded-full bg-[#F2F2F2] px-8 py-3 text-sm font-semibold leading-[120%] text-[#4D4D4D] transition-colors hover:bg-gray-200"
                                >
                                    Update Cart
                                </motion.button>
                            </div>
                        </div>
                        {/* Coupon Section */}
                        <div className="flex flex-col items-center gap-6 p-6 mt-5 border rounded-2xl md:flex-row md:justify-between lg:flex-row lg:items-center lg:justify-between">
                            <h2 className="my-5 text-xl font-medium leading-[120%] text-[#1a1a1a]">
                                Coupon Code
                            </h2>
                            <div className="relative flex flex-col flex-1 gap-5 md:block">
                                <input
                                    value={coupon}
                                    onChange={(e) => setCoupon(e.target.value)}
                                    type="text"
                                    placeholder="Enter Code"
                                    className="w-full rounded-full border px-6 py-4 pr-44 font-normal leading-[120%] text-[#999999]"
                                />
                                <motion.button
                                    {...buttonAnimation}
                                    onClick={applyCoupon}
                                    className="rounded-full bg-[#333333] px-10 py-3 text-xl font-semibold text-white transition-colors hover:bg-[#171717] md:absolute md:right-0 md:top-0"
                                >
                                    Apply Coupon
                                </motion.button>
                            </div>
                        </div>
                    </div>
                    {/* Summary Card */}
                    <div className="p-6 border h-fit rounded-2xl">
                        <h1 className="mb-10 text-left text-xl font-medium leading-[150%] text-[#1A1A1A]">
                            Cart Table
                        </h1>
                        <div className="flex flex-col gap-4">
                            <div className="flex items-center justify-between p-4 border-b">
                                <p className="font-normal leading-[150%] text-[#4D4D4D]">
                                    Subtotal
                                </p>
                                <p className="text-sm font-medium leading-[150%] text-[#1A1A1A]">
                                    ${total.toFixed(2)}
                                </p>
                            </div>
                            <div className="flex items-center justify-between p-4 border-b">
                                <p className="font-normal leading-[150%] text-[#4D4D4D]">
                                    Shipping
                                </p>
                                <p className="text-sm font-medium leading-[150%] text-[#1A1A1A]">
                                    Free
                                </p>
                            </div>
                            <div className="flex items-center justify-between p-4 border-b">
                                <p className="font-normal leading-[150%] text-[#4D4D4D]">
                                    Total
                                </p>
                                <p className="text-sm font-semibold leading-[150%] text-[#1A1A1A]">
                                    ${total.toFixed(2)}
                                </p>
                            </div>
                            <motion.button
                                {...buttonAnimation}
                                onClick={proceedToCheckout}
                                className="rounded-full bg-[#00B207] px-10 py-4 font-semibold leading-[120%] text-white transition-colors hover:bg-green-700"
                            >
                                Proceed to Checkout
                            </motion.button>
                        </div>
                    </div>
                </div>
            </section>
        </MainLayout>
    );
}